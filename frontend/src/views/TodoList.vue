<template>
    <div>
        <h1>TODOリスト</h1>
        <todo-list />
    </div>
</template>

<script>
import TodoList from "@/components/TodoListComponent.vue";

export default {
    components: {
        TodoList,
    },
};
</script>
