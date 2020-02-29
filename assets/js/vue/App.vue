<template>
    <div>
        <p>{{ greeting }} world</p>

        <p v-if="!items">Loading!</p>

        <ul v-if="items">
            <li v-for="item in items">{{item.name}}</li>
        </ul>
    </div>
</template>

<script>
    import {itemMixin} from './mixins/item';

    export default {
        mixins: [itemMixin],
        data: () => {return {greeting: 'Hello', items: null}},
        mounted: init
    };

    function init() {
       this.getItems()
        .then(items => this.items = items);
    }
</script>

<style scoped lang="scss">

</style>