<template>
    <div>
      <ul>
        <li v-for="item in data" :key="item.id">{{ item.name }}</li>
      </ul>
      <a href="tasks">TODOリスト</a>
    </div>
</template>

<script>
import axios from 'axios';

export default {

    data() {
        return {
        data: [],
        };
    },
    mounted() {
        this.loadData();
    },
    methods: {
        loadData() {
            axios.get('http://localhost:8000/api/data').then(response => {
                this.data = response.data;
            })
            .catch(error => {
                console.error(error);
            });
        },
    },
};
</script>
  