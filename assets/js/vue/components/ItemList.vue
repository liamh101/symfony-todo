<template>
    <div>
        <p v-if="!items">Loading!</p>
        <ul v-if="items" class="list-group">
            <li class="list-group-item" v-for="item in items">{{item.name}}</li>
        </ul>
    </div>
</template>

<script>
    import {itemMixin} from '../mixins/item';

    export default {
        mixins: [itemMixin],
        props: {
            items: {
                type: Array,
                required: true,
            }
        },
    };
</script>

<style scoped lang="scss">

</style>