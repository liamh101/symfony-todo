<template>
    <div>
        <div v-if="items" class="list-group">
            <ToDoItem v-for="(item, index) in items" v-bind:item="item" v-on:itemRemoved="removeItemFromList(index)" />
        </div>

        <div v-if="!items.length">
            <p class="text-center">You have no items!</p>
        </div>
    </div>
</template>

<script>
    import {itemMixin} from '../mixins/item';
    import ToDoItem from "./ToDoItem";

    export default {
        components: {ToDoItem},
        mixins: [itemMixin],
        props: {
            items: {
                type: Array,
                required: true,
            }
        },
        methods: {
            removeItemFromList(itemIndex) {
                this.items.splice(itemIndex, 1);
            }
        }
    };
</script>

<style scoped lang="scss">

</style>