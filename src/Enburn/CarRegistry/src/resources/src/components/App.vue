<template>
    <section class="section">
        <Nav></Nav>
        <hr>

        <div class="container">
            <router-view></router-view>
        </div>
    </section>
</template>

<script>
import Nav from "./Nav";
export default {
    name: "App",
    components: {Nav}
}
</script>

<style scoped>

</style>
