<template>
    <nav>
        <div class="buttons">
            <button class="button ">
                <router-link to="/">Overview</router-link>
            </button>

            <button class="button ">
                <router-link to="/brands">Brands</router-link>
            </button>
        </div>
    </nav>
</template>

<script>
export default {
    name: "Nav"
}
</script>

<style scoped>

</style>
