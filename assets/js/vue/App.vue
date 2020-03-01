<template>
    <b-container>
        <b-row>
            <b-col>
                <h1 class="text-center">ToDo List!</h1>
            </b-col>
        </b-row>

        <b-row>
            <b-col>
                <ItemInput v-on:newItem="addItem" class="mb-2"/>
                <ItemList v-if="!loading" v-bind:items="items"/>

                <div class="text-center">
                    <b-spinner v-if="loading" label="Loading..."></b-spinner>
                </div>

            </b-col>
        </b-row>
    </b-container>
</template>

<script>
    import ItemList from "./components/ItemList";
    import ItemInput from "./components/ItemInput";
    import {itemMixin} from "./mixins/item";

    export default {
        mixins: [itemMixin],
        components: {ItemInput, ItemList},
        data() {return {items:[], loading: true}},
        mounted() {
            this.getItems()
                .then((items) => {
                    this.items = items;
                    this.loading = false;
                });
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