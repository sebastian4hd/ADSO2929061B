"use strict";
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
function getUser(userId) {
    return __awaiter(this, void 0, void 0, function* () {
        const url = 'https://jsonplaceholder.typicode.com/users/' + userId;
        const res = yield fetch(url);
        return res;
    });
}
const output14 = document.getElementById('output15');
if (output14) {
    getUser(1)
        .then(res => res.json())
        .then(data => {
        let user = data;
        output14.innerHTML += `<li class='badge badge-success text-xl p-4'>${user.name} <span class='badge badge-warning text-white'>${user.username}</span></li>`;
    });
    getUser(5)
        .then(res => res.json())
        .then(data => {
        let user = data;
        output14.innerHTML += `<li class='badge badge-success text-xl p-4'>${user.name} <span class='badge badge-warning text-white'>${user.username}</span></li>`;
    });
}
