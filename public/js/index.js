let count = document.getElementById('count');
let total = document.getElementById('total');

let addToCartButtons = document.querySelectorAll('.addToCartButton');
let delFromCartButtons = document.querySelectorAll('.delFromCartButton');

let allOrders = document.getElementById('allOrders');
let inAwait = document.getElementById('await');
let inProcess = document.getElementById('process');
let inFinish = document.getElementById('finish');
let inDelete = document.getElementById('delete');
let orders__wrap = document.querySelector('.orders__wrap');

if (allOrders !== null) {
    allOrders.addEventListener('click', (element) => showOrders(element.target.id));
    inAwait.addEventListener('click', (element) => showOrders(element.target.id));
    inProcess.addEventListener('click', (element) => showOrders(element.target.id));
    inFinish.addEventListener('click', (element) => showOrders(element.target.id));
    inDelete.addEventListener('click', (element) => showOrders(element.target.id));
}

getCount();

addToCartButtons.forEach((element) => {
    element.addEventListener('click', () => addToCartButton(element.getAttribute('data-id')));
});

delFromCartButtons.forEach((element) => {
    element.addEventListener('click', () => delFromCartButton(element));
});

async function showOrders(type) {
    orders__wrap.innerHTML = "";

    let response = await fetch('/order/getOrders', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify({
            ordersType: type
        }),
    });

    let result = await response.json();

    if (result.status === 'ok') {
        renderOrders(result.orders, type);
    } else {
        throw new Error("Ошибка сервера")
    }
}

async function changeStatus(newStatus) {
    let type = event.srcElement.dataset.type;
    let session_id = event.srcElement.dataset.id;

    let response = await fetch('/order/changeStatus', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify({
            newStatus: newStatus,
            session_id: session_id,
        }),
    });

    let result = await response.json();

    if (result.status === 'ok') {
        showOrders(type);
    } else {
        throw new Error("Ошибка сервера")
    }
}

function renderOrders(orders, type) {
    for (let order in orders) {
        orders__wrap.innerHTML +=
            `<div class="contentHeader contentHeader_margin contentHeader_direction" >
                <div> Дата заказа: ${orders[order][0]['date']} </div>
                <div> Статус заказа: ${orders[order][0]['status']} </div>
                <div > Телефон клиента: ${orders[order][0]['phone']} </div>
                <div > Логин клиента: ${orders[order][0]['login']} </div>
            <div>`;
        if (orders[order][0]['status'] === 'await') {
            orders__wrap.innerHTML +=
                `<button class = "orders__button" data-type = "${type}" data-id = "${orders[order][0]['session_id']}" onClick="changeStatus('process')"> Взять в обработку </button>`;
        } else if (orders[order][0]['status'] === 'process') {
            orders__wrap.innerHTML +=
                `<a class = "orders__button" data-type = "${type}" data-id = "${orders[order][0]['session_id']}" onClick="changeStatus('finish')"> Завершить </a>
                <a class = "orders__button" data-type = "${type}" data-id = "${orders[order][0]['session_id']}" onClick="changeStatus('delete')"> Отменить </a>`;
        }
        orders__wrap.innerHTML +=
            `</div>
        </div>`;
        for (let item in orders[order]) {
            orders__wrap.innerHTML +=
                `<div class="productUnit__orders ${orders[order][item]['corner']}">
                    <img title="${orders[order][item]['name']}" class="productImg" src="${orders[order][item]['address']}" alt="${orders[order][item]['name']}">
                    <div class="productName">
                        ${orders[order][item]['name']}
                    </div>
                    <div class="productPriceWrap">
                        <div class="actualPrice">
                            &euro; ${orders[order][item]['actualPrice']}
                        </div>`;
            if (orders[order][item]['oldPrice']) {
                orders__wrap.innerHTML +=
                    `<div class="oldPrice">
                                &euro; ${orders[order][item]['oldPrice']}
                            </div>
                        </div>
                </div>`;
            }
        }
        orders__wrap.innerHTML += `<hr>`;
    }
}

async function getCount() {
    let response = await fetch('/cart/getCount');
    let result = await response.json();

    if (result.status === 'ok') {
        count.textContent = result.count;
    } else {
        throw new Error("Ошибка сервера")
    }
}

async function addToCartButton(id) {
    let response = await fetch('/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify({
            id: id
        }),
    });

    let result = await response.json();

    if (result.status === 'ok') {
        count.textContent = result.count;
    } else {
        throw new Error("Ошибка сервера")
    }
}

async function delFromCartButton(element) {
    let uniqId = element.getAttribute('data-uniqId');
    let elementId = element.parentElement;

    let response = await fetch('/cart/del', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify({
            uniqId: uniqId
        }),
    });

    let result = await response.json();

    if (result.status === 'ok') {
        count.textContent = result.count;
        total.textContent = result.total;
        elementId.remove();
    } else {
        throw new Error("Ошибка сервера")
    }
}
