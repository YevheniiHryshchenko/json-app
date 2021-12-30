<template>
  <div class="Dashboard__pagination">
    {{ createIterator() }}
    <ul v-if="backendData.pages > 1" class="pagination text-center">
      <li v-if="backendData.current_page == 1" class="disabled">
        <span>First</span>
      </li>
      <li v-else>
        <router-link to="1">First</router-link>
      </li>
      <li v-if="iterator !== 1" class="disabled"><span>...</span></li>
      <template v-for="i in backendData.pages">
        <template v-if="firstCheckPagination()">
          <li v-if="iterator == backendData.current_page" class="active">
            <span>{{ iterator }}</span>
          </li>
          <li v-else>
            <router-link :to="String(iterator)">{{ iterator }}</router-link>
          </li>
          <li v-if="secondCheckPagination()" class="disabled">
            <span>...</span>
          </li>
          {{ incrementIterator() }}
        </template>
      </template>
      <li v-if="backendData.current_page == backendData.pages" class="disabled">
        <span>Last</span>
      </li>
      <li v-else>
        <router-link :to="String(backendData.pages)">Last</router-link>
      </li>
    </ul>
  </div>
</template>
<script>
export default {
  props: ["backendData"],
  data() {
    return {
      maxCount: 5,
      sideCount: 4
    };
  },
  methods: {
    createIterator() {
      this.iterator =
        Number(this.backendData.current_page) > this.maxCount
          ? Number(this.backendData.current_page) - this.sideCount
          : 1;
    },
    firstCheckPagination() {
      return (
        this.iterator <=
          Number(this.backendData.current_page) + this.sideCount &&
        this.iterator <= this.backendData.pages
      );
    },
    secondCheckPagination() {
      return (
        this.iterator ==
          Number(this.backendData.current_page) + this.sideCount &&
        this.iterator < this.backendData.pages
      );
    },
    incrementIterator() {
      this.iterator++;
    }
  }
};
</script>

<style lang="scss" scoped>
@import "@/assets/scss/components/_PaginationMenu.scss";
</style>