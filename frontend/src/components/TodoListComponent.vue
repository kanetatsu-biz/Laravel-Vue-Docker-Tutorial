<template>
    <div class="column-center">
        <h1 class="main-title">TODOリスト</h1>
        <div>
            <h2 class="sub-title">未達成</h2>
            <div class="column-center">
                <div class="task-container" v-for="task in undone_tasks" :key="task.id">
                    <button class="checkbox" @click="updateTask(task.id)"></button>
                    <span class="task-title">{{ task.title }}</span>
                    <button class="delete-btn" @click="showConfirmModal(task.id)">&#9003;</button>
                </div>
                <div v-show="show_input" class="task-container">
                    <button class="delete-btn" @click="deleteTaskInput()">&#8998;</button>
                    <input type="text" placeholder="タスク名" v-model="input_task_name" class="task-input">
                    <button class="create-btn" @click="createTask()">登録</button>
                </div>
                <button class="add-btn" @click="showTaskInput()">&plus;</button>
            </div>
        </div>
        <div>
            <h2 class="sub-title">達成済み</h2>
            <div class="column-center">
                <div class="task-container" v-for="task in done_tasks" :key="task.id">
                    <button class="checkbox" @click="updateTask(task.id)">
                        <span class="check">&check;</span>
                    </button>
                    <div class="task-title">
                        <span>{{ task.title }}</span>
                        <br>
                        <span class="datetime">{{ '(' + formatDatetime(task.updated_at) + ')' }}</span>
                    </div>
                    <button class="delete-btn" @click="showConfirmModal(task.id)">&#9003;</button>
                </div>
            </div>
        </div>

        <confirm-modal
            :action_name="'削除'"
            v-show="show_modal"
            @confirm-method="confirmDelete"
        ></confirm-modal>
    </div>
</template>

<script>
import axios from 'axios';
import moment from "moment";
import confirmModal from './confirmModal.vue';

export default {
    components: { confirmModal },
    data() {
        return {
            base_url: 'http://localhost:8000/api/',
            tasks: [],
            undone_tasks: [],
            done_tasks: [],
            show_modal: false,
            delete_id: null,
            show_input: false,
            input_task_name: '',
        };
    },
    mounted() {
        this.getTasks();
    },
    methods: {
        // タスクを取得しSET
        getTasks() {
            axios.get(this.base_url + 'index').then(response => {
                this.tasks = response.data;
                this.divideTasks();
            })
            .catch(error => {
                console.error(error);
            });
        },
        // 達成済みと未達成のタスクに分ける
        divideTasks() {
            this.tasks.forEach(task => {
                if (task.completed) {
                    this.done_tasks.push(task);
                } else {
                    this.undone_tasks.push(task);
                }
            });
        },
        resetTasks() {
            this.done_tasks = [];
            this.undone_tasks = [];
            this.getTasks();
        },
        // タスクを更新
        updateTask(task_id) {
            axios.post(this.base_url + task_id + '/update').then(response => {
                // 更新後のデータを取得し表示データをリセット
                if (response.data) {
                    this.resetTasks();
                }
            })
            .catch(error => {
                console.error(error);
            });
        },
        // 日時をフォーマット化
        formatDatetime(datetime) {
            return moment(datetime).format('YYYY-MM-DD HH:mm');
        },
        // 削除確認モーダルを表示
        showConfirmModal(task_id) {
            this.show_modal = true;
            this.delete_id = task_id;
        },
        // 削除確認モーダル内の選択をもとに処理
        confirmDelete(is_confirmed) {
            if (is_confirmed) {
                // 削除APIを実行
                axios.post(this.base_url + this.delete_id + '/delete').then(response => {
                    // 更新後のデータを取得し表示データをリセット
                    if (response.data) {
                        this.resetTasks();
                    }
                })
                .catch(error => {
                    console.error(error);
                });
            }
            this.show_modal = false;
            this.delete_id = null;
        },
        // 新規タスクの入力フォームを表示
        showTaskInput() {
            this.show_input = true;
        },
        // 新規タスクの入力フォームを削除
        deleteTaskInput() {
            this.input_task_name = '';
            this.show_input = false;
        },
        // 新規タスクの登録APIを投げる
        createTask() {
            axios.post(
                this.base_url + 'create',
                { task_name: this.input_task_name }
            ).then(response => {
                // 更新後のデータを取得し表示データをリセット
                if (response.data) {
                    this.resetTasks();
                }
            })
            .catch(error => {
                console.error(error);
            });
            this.deleteTaskInput();
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
    gap: 25px;
}

.main-title {
    padding: 0.5em;
    background-color: #ffecec;
    position: relative;
}
.main-title::before {
    position: absolute;
    bottom: -10px;
    right: 0;
    z-index: -1;
    width: 100%;
    height: 50%;
    background-color: #bcbcbc;
    content: "";
    filter: blur(4px);
}
.main-title::after {
    content: url(../../public/horizontal_tape.png);
    position: absolute;
    top: -25px;
    right: 65px
}

.sub-title {
    width: 5em;
    padding: 0.5em;
    background-color: #fffce1;
    color: #4d4d4d;
    box-sizing: border-box;
    position: relative;
}
.sub-title::before {
    position: absolute;
    bottom: -5px;
    right: 0;
    z-index: -1;
    transform: rotate(5deg);
    width: 100%;
    height: 50%;
    background-color: #bcbcbc;
    content: "";
    filter: blur(4px);
}
.sub-title::after {
    content: url(../../public/diagonal_tape.png);
    position: absolute;
    top: -25px;
    right: 40px;
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
    font-size: 40px;
    height: 25px;
    margin-right: 10px;
    position: relative;
    width: 25px;
}
.checkbox:hover {
    background-color: gray;
}
.checkbox .check {
    background: transparent;
    left: -5px;
    position: absolute;
    top: -20px;
}

.task-title {
    background-color: white;
    border-right: 30px solid lightblue;
    padding: .5em 1em;
    position: relative;
    width: 90%;
}
.task-title::before {
    position: absolute;
    bottom: 2px;
    right: -20px;
    z-index: -1;
    transform: rotate(2.5deg);
    width: 100%;
    height: 50%;
    background-color: #bcbcbc;
    content: "";
    filter: blur(4px);
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

.task-input {
    font-size: 18px;
    height: 100%;
    width: 100%;
}

.create-btn {
    color: #fff;
    background-color: #eb6100;
    border-radius: 100vh;
}
.create-btn:hover {
    background: #f56500;
}
</style>