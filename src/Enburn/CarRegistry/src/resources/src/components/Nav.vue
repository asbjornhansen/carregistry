<template>
    <nav>
        <buttons>
            <button class="button ">
                <router-link to="/">Overview</router-link>
            </button>

            <button class="button ">
                <router-link to="/brands">Brands</router-link>
            </button>
        </buttons>
    </nav>
</template>

<script>
export default {
    name: "Nav"
}
</script>

<style scoped>

</style>
