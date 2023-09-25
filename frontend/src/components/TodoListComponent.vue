<template>
    <div class="column-center">
        <h1 class="main-title">TODOリスト</h1>
        <div class="todo-container">
            <h2 class="sub-title">未達成</h2>
            <ul class="column-center">
                <li v-for="task in undone_tasks" :key="task.id">{{ task.title }}</li>
            </ul>
            <button>&plus;</button>
        </div>
        <div class="todo-container">
            <h2 class="sub-title">達成済み</h2>
            <ul class="column-center">
                <li v-for="task in done_tasks" :key="task.id">{{ task.title }}</li>
            </ul>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            undone_tasks: [],
            done_tasks: [],
        };
    },
    mounted() {
        this.getTasks();
    },
    methods: {
        // タスクを取得しSET
        getTasks() {
            axios.get('http://localhost:8000/api/tasks').then(response => {
                this.divideTasks(response.data);
            })
            .catch(error => {
                console.error(error);
            });
        },
        // 達成済みと未達成のタスクに分ける
        divideTasks(tasks) {
            tasks.forEach(task => {
                if (task.completed) {
                    this.done_tasks.push(task);
                } else {
                    this.undone_tasks.push(task);
                }
            });
        },
    },
};
</script>

<style>
/* 中央揃え(共通部品) */
.column-center {
    align-items: center;
    display: flex;
    flex-flow: column;
}

.main-title {
    text-align: center;
}
.sub-title {
    text-decoration: underline;
}

.todo-container {
}
</style>