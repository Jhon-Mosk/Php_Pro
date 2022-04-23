<?php

namespace app\models;

use app\engine\App;

abstract class Repository
{
    abstract protected function getTableName();

    abstract protected function getEntityClass();

    public function getLimit($limit)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT 0, ?";

        return App::call()->db->queryLimit($sql, $limit);
    }

    public function getWhereAll($name, $value)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE {$name} = :{$name}";

        return App::call()->db->queryAll($sql, [$name => $value]);
    }

    public function getWhereOne($name, $value, $select = '*')
    {
        $tableName = $this->getTableName();
        $entityClass = $this->getEntityClass();
        $sql = "SELECT {$select} FROM {$tableName} WHERE {$name} = :{$name}";

        $result = App::call()->db->queryOneObject($sql, [$name => $value], $entityClass);

        return $result ? $result : $this;
    }

    public function getCountWhere($name, $value)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT COUNT(id) as count FROM {$tableName} WHERE {$name} = :{$name}";

        $result = App::call()->db->queryOne($sql, [$name => $value])['count'];

        return $result ? $result : 0;
    }

    public function getJoin($join, $on = [], $where = [])
    {
        //SELECT * FROM carts JOIN products ON (carts.product_id = products.id) WHERE `session_id` = '9ph407e45epm6l6d0sf4cp1ndhtqm68r'
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        $params = [];

        if (!empty($join)) {
            $sql .= " JOIN $join";
            // $sql .= " JOIN :join";
            // $params['join'] = $join;
        }

        if (!empty($on)) {
            $sql .= " ON (";

            foreach ($on as $key => $value) {
                $sql .= "{$key} = {$value}";
                // $sql .= "{$key} = :{$key}";
                // $params[$key] = $value;
                // if ($value != end($on)) $sql .= ", ";
                if ($value != end($on)) $sql .= ", ";
            }

            $sql .= ")";
        }

        if (!empty($where)) {
            $sql .= " WHERE ";

            foreach ($where as $key => $value) {
                $sql .= "{$key} = '{$value}'";
                // $sql .= "{$key} = ':{$key}'";
                // $params[$key] = $value;
                // if ($value != end($where)) $sql .= ", ";
                if ($value != end($where)) $sql .= ", ";
            }
        }

        return App::call()->db->queryJoin($sql, $params);
    }

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $entityClass = $this->getEntityClass();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        // return Db::getInstance()->queryOne($sql, ['id' => $id]);
        $result = App::call()->db->queryOneObject($sql, ['id' => $id], $entityClass);

        return $result ? $result : $this;
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return App::call()->db->queryAll($sql);
    }

    public function insert(Entity $entity)
    {
        $into = [];
        $values = [];
        $params = [];
        $tableName = $this->getTableName();

        foreach ($entity->props as $key => $value) {
            $into[] = $key;
            $values[] = ':' . $key;
            $params[$key] = $entity->$key;
        }

        $into = implode(',', $into);
        $values = implode(',', $values);

        $sql = "INSERT INTO {$tableName}({$into}) VALUES ({$values})";
        App::call()->db->execute($sql, $params);

        $entity->id = App::call()->db->lastInsertId();

        return $this;
    }

    public function update(Entity $entity)
    {
        $id = $entity->id;
        $tableName = $this->getTableName();
        $set = [];
        $params = [
            'id' => $id,
        ];

        foreach ($entity->props as $key => $value) {
            if ($value) {
                $set[] = $key . ' = :' . $key;
                $params[$key] = $entity->$key;
                $entity->props[$key] = false;
            }
        }

        if (!empty($set)) {
            $set = implode(',', $set);

            $sql = "UPDATE {$tableName} SET {$set} WHERE `id`= :id";

            App::call()->db->execute($sql, $params);
        }

        return $this;
    }

    public function delete(Entity $entity)
    {
        $id = $entity->id;
        $tableName = $this->getTableName();
        $params = [
            'id' => $id
        ];

        $sql = "DELETE FROM {$tableName} WHERE `id` = :id";

        return App::call()->db->execute($sql, $params);
    }

    public function save(Entity $entity)
    {
        (isset($entity->id)) ? $this->update($entity) : $this->insert($entity);
    }
}
