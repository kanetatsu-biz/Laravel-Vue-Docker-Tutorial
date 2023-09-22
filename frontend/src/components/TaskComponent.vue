<template>
    <div>
      <ul>
        <li v-for="task in tasks" :key="task.id">{{ task.title }}</li>
      </ul>
      <a href="/">TOPに戻る</a>
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
  