const output13 = document.getElementById('output13');

interface Post {
    userId: number;
    id: number;
    title: string;
    body: string;
}

async function getPost(): Promise<Post> {
    const res = await fetch("https://jsonplaceholder.typicode.com/posts/3");
    
    const data: Post = await res.json();
    
    return data;
}

if(output13){
    getPost().then(post => {
        console.log(post);
        for(let k in post){
            let key = k as keyof typeof post;
            output13.innerHTML += `<li class="border m-auto px-5 my-1 rounded-sm">${key}: ${post[key]}</li>`;
        }
    });
}