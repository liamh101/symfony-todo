<template>
    <div class="container-fluid">
        <h1 class="text-center">ToDo List!</h1>
        <ItemInput v-on:newItem="addItem"/>
        <ItemList v-if="items" v-bind:items="items"/>
    </div>
</template>

<script>
    import ItemList from "./components/ItemList";
    import ItemInput from "./components/ItemInput";
    import {itemMixin} from "./mixins/item";

    export default {
        mixins: [itemMixin],
        components: {ItemInput, ItemList},
        data() {return {items:[]}},
        mounted() {
            this.getItems().then((items) => this.items = items);
        },
        methods: {
            addItem(item) {
                this.items.push(item);
            }
        }
    };
</script>

<style scoped lang="scss">

</style>