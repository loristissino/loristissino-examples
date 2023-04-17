const values = [1, 3, 5, 10];
console.log(values.filter(x=>x>=5));
console.log(values.map(x=>x*2));
console.log(values.reduce((acc, x) => acc + x, 0));

const people = [
    {name: 'Alice', age: 20},
    {name: 'Bob', age: 22},
    {name: 'Charlie', age: 30},
    {name: 'Donna', age: 26},
];

console.log(people.filter(p=>p.age>=25));

console.log(people.reduce((acc, p) => acc + p.age, 0));

