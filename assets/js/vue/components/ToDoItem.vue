<template>
    <div class="list-group-item">
        <b-row>
            <b-col cols="11">
                <p v-text="item.name"></p>
            </b-col>
            <b-col cols="1">
                <b-icon
                        v-bind:icon="icon"
                        v-on:click="deleteItem"
                        font-scale="1.5"
                        @mouseover="icon = 'x-circle-fill'"
                        @mouseleave="icon = 'x-circle'"
                        variant="danger"></b-icon>
            </b-col>
        </b-row>
    </div>
</template>

<script>
    import {itemMixin} from '../mixins/item';

    export default {
        mixins: [itemMixin],
        data() {
            return {
                icon: 'x-circle',
            };
        },
        props: {
            item: {
                type: Object,
                required: true,
            }
        },
        methods: {
            deleteItem() {
                this.removeItem(this.item.id)
                    .then(() => this.$emit('itemRemoved', this.item.id))
            }
        }
    };
</script>

<style scoped lang="scss">

</style>