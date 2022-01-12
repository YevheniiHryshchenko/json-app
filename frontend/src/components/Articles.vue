<template>
  <div class="articles">
    <Header :pageName="pageName" />
    <div class="container">
      <div class="p-3 border mb-4">
        <h2>Category</h2>
        <hr>
        <select v-model="currentCategoryId" class="w-100 p-2" @change="changeCategory">
          <template v-for="category in categories">
            <option
              :key="category.id"
              :value="category.id"
            >
              {{category.name}}
            </option>
          </template>
        </select>
      </div>
      <div class="p-3 border mb-5">
        <h2>Search</h2>
        <hr>
        <input class="w-100 p-2 mb-3" v-model="searchedText" placeholder="Search in articles ...">
        <p><span class="font-italic">Searched text: </span>{{savedSearchedText}}</p>
        <hr>
        <button @click="searchText" type="button" class="btn btn-primary w-100">Search</button>
      </div>
      <Article
        :data="article"
        v-for="article in pageData.data"
        :key="article.id"
      />
      <PaginationMenu :backendData="pageData" />
    </div>
  </div>
</template>
<script>
import Header from "@/components/Header";
import Article from "@/components/Article";
import PaginationMenu from "@/components/PaginationMenu";
import axios from "axios";

export default {
  data() {
    return {
      pageData: [],
      searchedText: '',
      savedSearchedText: '',
      currentCategoryId: 0,
      categories: [
        {
          id: 0,
          name: "any"
        }
      ]
    };
  },
  computed: {
    pageName() {
      return "List";
    }
  },
  components: {
    Header,
    Article,
    PaginationMenu
  },
  mounted() {
    this.loadPageData(this.$route.params.num);
    this.loadCategories();
  },
  watch: {
    $route(to, from) {
      if (
        this.savedSearchedText === '' &&
        this.currentCategoryId === 0
      ) {
        this.loadPageData(this.$route.params.num);
      } else {
        this.getFilteredPageData();
      }
    }
  },
  methods: {
    searchText() {
      this.savedSearchedText = this.searchedText;
      this.startPageDataLoading();
    },
    changeCategory() {
      this.savedSearchedText = '';
      this.startPageDataLoading();
    },
    startPageDataLoading() {
      if (this.$route.params.num == '1') {
        this.getFilteredPageData();
      } else {
        this.$router.push({ path: '/articles/page/1' });
      }
    },
    checkPaginationRoute() {
      if (
        (this.pageData.pages !== 0 &&
          this.$route.params.num > this.pageData.pages) ||
        isNaN(Number(this.$route.params.num))
      ) {
        this.$router.push(`/error`);
      }
    },
    loadPageData(pageNum) {
      window.scrollTo(0, 0);
      this.pageData = [];
      console.log('Page data loading');

      axios
        .get(`${process.env.VUE_APP_BASE_URL}/api/articles?page=${pageNum}`)
        .then(response => {
          console.log('Response', response);
          this.savePageData(response.data);
          this.checkPaginationRoute();
        })
        .catch(error => {
          console.log(error.response.data);
        });
    },
    savePageData(data) {
      this.pageData = data;

      this.pageData.pages = Math.ceil(
        this.pageData.total / this.pageData.per_page
      );
    },
    getFilteredPageData() {
      window.scrollTo(0, 0);
      this.pageData = [];
      console.log('Page data loading');

      axios
        .post(
          `${process.env.VUE_APP_BASE_URL}/api/articles/getFilteredData`,
          {
            page: this.$route.params.num,
            categoryId: this.currentCategoryId,
            searchedText: this.savedSearchedText
          }
        )
        .then(response => {
          console.log('Response', response);
          this.savePageData(response.data);
          this.checkPaginationRoute();
        })
        .catch(error => {
          console.log(error.response.data);
        });
    },
    loadCategories() {
      axios
        .get(
          `${process.env.VUE_APP_BASE_URL}/api/categories`
        )
        .then(response => {
          this.categories.push(...response.data);
        })
        .catch(error => {
          console.log(error.response.data);
        });
    }
  }
};
</script>
<style lang="scss" scoped>
@import "@/assets/scss/components/_Articles.scss";
</style>
