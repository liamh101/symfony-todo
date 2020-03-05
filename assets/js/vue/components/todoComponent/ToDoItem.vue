<template>
    <div class="list-group-item" v-bind:class="{disabled: disable}">
        <b-row>
            <b-col cols="11">
                <p v-text="item.name"/>
            </b-col>
            <b-col cols="1">
                <b-iconstack font-scale="1.5"
                             class="action-button"
                             variant="success"
                             @mouseover="successHover = true"
                             @mouseleave="successHover = false"
                             v-on:click="completeItem"
                >
                    <b-icon stacked v-bind:icon="successHover ? 'circle-fill' : 'circle'"/>
                    <b-icon stacked icon="check" v-bind:variant="successHover ? 'white' : 'success'"/>
                </b-iconstack>

                <b-icon
                        v-bind:icon="deleteIcon"
                        v-on:click="deleteItem"
                        class="action-button"
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
                disable: false,
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
                this.disable = true;

                this.removeItem(this.item.id)
                    .then(() => this.$emit('itemRemoved', this.item.id))
                    .finally(() => this.disable = false);
            },
            completeItem() {
                this.disable = true;
                this.item.completed = true;

                this.updateItem(this.item)
                    .then(() => this.$emit('itemRemoved', this.item.id))
                    .finally(() => this.disable = false);
            }
        }
    };
</script>

<style scoped lang="scss">
    @import "~bootstrap/scss/bootstrap.scss";



    .disabled {
        background-color: $gray-100 !important;

        p {
            color: $text-muted;
        }

        .action-button {
            cursor: not-allowed !important;
            color: $gray-600 !important;

            svg {
                color: $gray-600 !important;
            }
        }
    }


    .action-button {
        cursor: pointer;
    }
</style>