<template>
  <!--begin::Dashboard-->
  <div class="row g-5 g-xl-8" v-for="(category, index) in root_categories.data" :key="index">
    <div class="col-xl-4">
      <router-link
          class="nav-link text-active-primary me-6"
          :to="{ name: 'category-children', params: {id: category.id } }"
      >
      <StatisticsWidget5
          widget-classes="card-xl-stretch mb-xl-8"
          svg-icon="media/icons/duotune/ecommerce/ecm002.svg"
          color="danger"
          v-if="(index % 4)==1"
          icon-color="white"
          :title="category.name"
          :description="category.discount"
      ></StatisticsWidget5>
      <StatisticsWidget5
          widget-classes="card-xl-stretch mb-xl-8"
          svg-icon="media/icons/duotune/ecommerce/ecm002.svg"
          color="primary"
          v-if="(index % 4)==2"
          icon-color="white"
          :title="category.name"
          :description="category.discount"
      ></StatisticsWidget5>
      <StatisticsWidget5
          widget-classes="card-xl-stretch mb-xl-8"
          svg-icon="media/icons/duotune/ecommerce/ecm002.svg"
          color="success"
          v-if="(index % 4)==3"
          icon-color="white"
          :title="category.name"
          :description="category.discount"
      ></StatisticsWidget5>
      <StatisticsWidget5
          widget-classes="card-xl-stretch mb-xl-8"
          svg-icon="media/icons/duotune/ecommerce/ecm002.svg"
          color="warning"
          v-if="(index % 4)==0"
          icon-color="white"
          :title="category.name"
          :description="category.discount"
      ></StatisticsWidget5>
      </router-link>
    </div>
  </div>
  <!--end::Row-->
  <!--end::Dashboard-->
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import StatisticsWidget5 from "@/components/widgets/categories/category.vue";
import { setCurrentPageTitle } from "@/core/helpers/breadcrumb";
import {useStore} from "vuex";
import axios from "axios";

export default defineComponent({
  name: "menu",
  components: {
    StatisticsWidget5
  },
  data: function() {
    return {
      root_categories : [],
      token: {},
    }
  },
  mounted() {
    const store = useStore();
    this.token = store.getters.userToken;
    this.getRootCategories();
  },
  methods: {
    getRootCategories()
    {
      const self = this;
      axios.defaults.headers.get['header-name'] = 'value';
      axios.defaults.headers.get['Access-Control-Allow-Origin'] = '*';
      axios.get(process.env.VUE_APP_API_URL + '/menu-root-categories?token='+self.token)
          .then(function (response) {
            self.root_categories = response.data;
          })
          .catch(function (error) {
            console.log(error);
          });
    },
  },
  setup() {
    onMounted(() => {
      setCurrentPageTitle("Menu");
    });
  },
});
</script>
