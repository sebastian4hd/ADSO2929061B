"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
const output13 = document.getElementById('output13');
async function getPost() {
    const res = await fetch("https://jsonplaceholder.typicode.com/posts/3");
    const data = await res.json();
    return data;
}
if (output13) {
    getPost().then(post => {
        console.log(post);
        for (let k in post) {
            let key = k;
            output13.innerHTML += `<li class="border m-auto px-5 my-1 rounded-sm">${key}: ${post[key]}</li>`;
        }
    });
}
//# sourceMappingURL=13-async-await.js.map