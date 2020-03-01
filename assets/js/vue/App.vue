<template>
    <b-container>
        <b-row>
            <b-col>
                <h1 class="text-center">ToDo List!</h1>
            </b-col>
        </b-row>

        <ToDoComponent/>
    </b-container>
</template>

<script>
    import ToDoComponent from "./components/todoComponent/ToDoComponent";

    export default {
        components: {ToDoComponent},
    };
</script>

<style scoped lang="scss">

</style>