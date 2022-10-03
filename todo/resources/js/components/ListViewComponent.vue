<template>
    <div class="mt-4 bg-white shadow-sm rounded-4 mb-5">
        <h2 class="text-center display-5 py-3 text-primary">My tasks</h2>
        <ul class="list-group m-auto" v-if="showList">
            <list-item
                :item="item"
                v-on:itemchanged="$emit('reloadlist')"
                v-for="item in items"
                :key="item.id"
                class="m-auto my-1 text-justify text-wrap"
            />
        </ul>
        <div v-else class="text-center alert alert-default text-muted">No task yet</div>
    </div>
</template>

<script>
import listItem from "./ListItemComponent";

export default {
    props: ["items"],
    components: {
        listItem
    },
    computed: {
        showList() {
            return this.items.length !== 0
        }
    }
};
</script>
<style  scoped>
h4 span {
    font-size:13px;
}
.list-group {
    border-radius:0;
}
</style>
