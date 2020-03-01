<template>
    <input class="form-control" v-model="name" :disabled="saving" v-on:keyup.enter="submit(name)">
</template>

<script>
    import {itemMixin} from '../mixins/item';

    export default {
        mixins: [itemMixin],
        data: () => {return {name: null, saving: false}},
        methods: {
            submit(name) {
                this.saving = true;
                this.createItem(name)
                    .then(item => {
                        this.$emit('newItem', item);
                        this.name = null;
                    })
                    .finally(()  => this.saving = false);
            }
        }
    };
</script>

<style scoped lang="scss">

</style>