'use strict';

const toastEl = document.getElementById('liveToast');
const liveToast = {
    show: (message) => {
        toastEl.querySelector('#toastMessage').innerText = message;
        $(toastEl).toast('show');

        setTimeout(clearMessage, 3000, toastEl);
    }
}

function clearMessage(toastEl) {
    toastEl.querySelector('#toastMessage').innerText = '';
}