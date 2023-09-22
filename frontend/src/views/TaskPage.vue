<template>
  <div>
    <h1>TODOリスト</h1>
    <task-component />
  </div>
</template>
  
<script>
import TaskComponent from "@/components/TaskComponent.vue";

export default {
  components: {
    TaskComponent,
  },
};
</script>
