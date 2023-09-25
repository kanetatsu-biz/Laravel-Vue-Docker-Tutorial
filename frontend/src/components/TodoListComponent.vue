<template>
    <div class="main-container">
        <h1 class="main-title">TODOリスト</h1>
        <h2 class="sub-title">未達成</h2>
        <div class="todo-container">
            <ul>
                <li v-for="task in tasks" :key="task.id">{{ task.title }}</li>
            </ul>
            <button>&plus;</button>
        </div>
        <h2 class="sub-title">達成済み</h2>
        <div class="todo-container">
            <ul>
                <li v-for="task in tasks" :key="task.id">{{ task.title }}</li>
            </ul>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            tasks: [],
        };
    },
    mounted() {
        this.getTasks();
    },
    methods: {
        getTasks() {
            axios.get('http://localhost:8000/api/tasks').then(response => {
                this.tasks = response.data;
            })
            .catch(error => {
                console.error(error);
            });
        },
    },
};
</script>

<style>
.main-container {
    margin: 0 100px;
}

.main-title {
    text-align: center;
}
.sub-title {
    text-decoration: underline;
}

.todo-container {
    align-items: center;
    display: flex;
    flex-flow: column;
}
</style>