<template>
    <div class="container-fluid">
        <h1 class="text-center">ToDo List!</h1>

        <ItemList/>
    </div>
</template>

<script>
    import ItemList from "./components/ItemList";

    export default {
        components: {ItemList},
    };
</script>

<style scoped lang="scss">

</style>