<template>
    <b-row>
        <b-col>
            <ItemInput v-on:newItem="addItem" class="mb-2"/>
            <ItemList v-if="!loading" v-bind:items="items"/>

            <div class="text-center">
                <b-spinner v-if="loading" variant="primary" label="Loading..."></b-spinner>
            </div>

        </b-col>
    </b-row>
</template>

<script>
    import ItemList from "./ItemList";
    import ItemInput from "./ItemInput";
    import {itemMixin} from "../../mixins/item";

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