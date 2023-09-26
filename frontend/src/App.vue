<template>
    <div>
        <router-view></router-view>
        <footer>
            <p>&copy; kanetatsu-biz. 2023.</p>
        </footer>
    </div>
</template>

<script>
export default {
    name: "App",
    components: {},
};
</script>

<style>
footer {
    margin-top: 50px;
    text-align: center;
}
</style>