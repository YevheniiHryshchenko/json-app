<template>
  <div>
    <Header :pageName="pageName" />
    <div id="notfound">
      <div class="notfound">
        <div class="notfound-404">
          <h3>Page not found</h3>
          <h1><span>4</span><span>0</span><span>4</span></h1>
        </div>
        <h2>the page you requested was not found</h2>
      </div>
    </div>
  </div>
</template>

<script>
import Header from "@/components/Header";

export default {
  computed: {
    pageName() {
      return "Error Page";
    }
  },
  components: {
    Header
  }
};
</script>

<style lang="scss" scoped>
@import "@/assets/scss/components/_Error.scss";
</style>
