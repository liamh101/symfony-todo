<template>
    <div class="list-group-item">
        <b-row>
            <b-col cols="11">
                <p v-text="item.name"/>
            </b-col>
            <b-col cols="1">
                <b-iconstack font-scale="1.5"
                             variant="success"
                             @mouseover="successHover = true"
                             @mouseleave="successHover = false"
                             v-on:click="completeItem"
                >
                    <b-icon stacked v-bind:icon="successHover ? 'circle-fill' : 'circle'" />
                    <b-icon stacked icon="check" v-bind:variant="successHover ? 'white' : 'success'"/>
                </b-iconstack>
                <b-icon
                        v-bind:icon="deleteIcon"
                        v-on:click="deleteItem"
                        font-scale="1.5"
                        @mouseover="deleteIcon = 'x-circle-fill'"
                        @mouseleave="deleteIcon = 'x-circle'"
                        variant="danger"
                />
            </b-col>
        </b-row>
    </div>
</template>

<script>
    import {itemMixin} from '../../mixins/item';

    export default {
        mixins: [itemMixin],
        data() {
            return {
                deleteIcon: 'x-circle',
                successHover: false,
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
            },
            completeItem() {
                this.item.completed = true;

                this.updateItem(this.item);
            }
        }
    };
</script>

<style scoped lang="scss">

</style>