interface User {
    id: number,
    name: string,
    username: string
}

async function getUser(userId: number): Promise<Response> {
    const url = 'https://jsonplaceholder.typicode.com/users/' + userId;
    const res = await fetch(url);
    return res;
}

const output14 = document.getElementById('output15');

if(output14){
    getUser(1)
    .then(res => res.json())
    .then(data => {
        let user: User = data;
        
        output14.innerHTML += `<li class='badge badge-success text-xl p-4'>${user.name} <span class='badge badge-warning text-white'>${user.username}</span></li>`;
    })

    getUser(5)
    .then(res => res.json())
    .then(data => {
        let user: User = data;
        
        output14.innerHTML += `<li class='badge badge-success text-xl p-4'>${user.name} <span class='badge badge-warning text-white'>${user.username}</span></li>`;
    })
}