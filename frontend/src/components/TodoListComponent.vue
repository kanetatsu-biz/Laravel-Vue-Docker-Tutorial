<template>
    <div class="column-center">
        <h1 class="main-title">TODOリスト</h1>
        <div>
            <h2 class="sub-title">未達成</h2>
            <div class="column-center">
                <div class="task-container" v-for="task in undone_tasks" :key="task.id">
                    <button class="checkbox"></button>
                    <span class="task-title">{{ task.title }}</span>
                    <button class="delete-btn">&#9003;</button>
                </div>
                <button class="add-btn">&plus;</button>
            </div>
        </div>
        <div>
            <h2 class="sub-title">達成済み</h2>
            <div class="column-center">
                <div class="task-container" v-for="task in done_tasks" :key="task.id">
                    <button class="checkbox"></button>
                    <div class="task-title">
                        <span>{{ task.title }}</span>
                        <span class="datetime">{{ '(' + formatDatetime(task.updated_at) + ')' }}</span>
                    </div>
                    <button class="delete-btn">&#9003;</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import moment from "moment";

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
        // 日時をフォーマット化
        formatDatetime(datetime) {
            return moment(datetime).format('YYYY-MM-DD HH:mm');
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
    gap: 10px;
}

.main-title {
    text-align: center;
}
.sub-title {
    text-decoration: underline;
}

.task-container {
    align-items: center;
    display: grid;
    grid-template-columns: 10% 80% 10%;
    justify-items: center;
    width: 60vw;
}

.checkbox {
    border: 2px solid black;
    border-radius: 5px;
    cursor: pointer;
    height: 25px;
    margin-right: 10px;
    width: 25px;
}
.checkbox:hover {
    background-color: gray;
}

.task-title {
    background-color: white;
    box-shadow: 0 3px 3px 0 rgba(0, 0, 0, .5);
    border-right: 30px solid lightblue;
    padding: .5em 1em;
}

.datetime {
    float: right;
}

.delete-btn {
    background: transparent;
    border: none;
    cursor: pointer;
    font-size: 25px;
    text-align: center;
}
.delete-btn:hover {
    transform: scale(1.4);
}

.add-btn {
    background: transparent;
    border-radius: 6px;
    color: black;
    cursor: pointer;
    font-size: 30px;
    position: relative;
    transition: .3s;
    width: 40px;
}
.add-btn::before {
    background: radial-gradient(ellipse at center, rgba(0, 0, 0, 0.35) 0%, rgba(0, 0, 0, 0) 80%);
    content: "";
    height: 10px;
    left: 5%;
    position: absolute;
    top: 100%;
    transition: .3s;
    width: 90%;
    z-index: -1;
}
.add-btn:hover {
    transform: translateY(-5px);
}
.add-btn:hover::before {
    transform: translateY(5px);
}
</style>