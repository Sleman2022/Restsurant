<template>
  <!--begin::Dashboard-->
  <div v-if="sub_categories.length">
    <div class="row g-5 g-xl-8" v-for="(category, index) in sub_categories" :key="index">
      <div class="col-xl-4">
        <router-link
            @click="updateData()"
            class="nav-link text-active-primary me-6"
            :to="{ name: 'category-children4', params: {id: category.id } }"
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
  </div>
  <div v-if="items.length">
    <div class="row g-5 g-xl-8" v-for="(item, index) in items" :key="index">
      <div class="col-xl-3">
        <StatisticsWidget5
            widget-classes="card-xl-stretch mb-xl-8"
            svg-icon="media/icons/duotune/ecommerce/ecm002.svg"
            color="danger"
            v-if="(index % 4)==1"
            icon-color="white"
            :title="item.name"
            :description="item.price"
        ></StatisticsWidget5>
        <StatisticsWidget5
            widget-classes="card-xl-stretch mb-xl-8"
            svg-icon="media/icons/duotune/ecommerce/ecm002.svg"
            color="primary"
            v-if="(index % 4)==2"
            icon-color="white"
            :title="item.name"
            :description="item.price"
        ></StatisticsWidget5>
        <StatisticsWidget5
            widget-classes="card-xl-stretch mb-xl-8"
            svg-icon="media/icons/duotune/ecommerce/ecm002.svg"
            color="success"
            v-if="(index % 4)==3"
            icon-color="white"
            :title="item.name"
            :description="item.price"
        ></StatisticsWidget5>
        <StatisticsWidget5
            widget-classes="card-xl-stretch mb-xl-8"
            svg-icon="media/icons/duotune/ecommerce/ecm002.svg"
            color="warning"
            v-if="(index % 4)==0"
            icon-color="white"
            :title="item.name"
            :description="item.price"
        ></StatisticsWidget5>
      </div>
    </div>
  </div>
  <!--end::Row-->
  <!--end::Dashboard-->
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import StatisticsWidget5 from "@/components/widgets/categories/category.vue";
import axios from "axios";
import {useStore} from "vuex";

export default defineComponent({
  name: "category-children4",
  props: {
  },
  components: {
    StatisticsWidget5
  },
  data: function() {
    return {
      id: this.$route.params.id,
      sub_categories : [],
      items: [],
      token: {},
    }
  },
  mounted() {
    const store = useStore();
    this.token = store.getters.userToken;
    this.getData();
  },
  methods: {
    getData()
    {
      const self = this;
      self.sub_categories = [];
      self.items = [];
      self.id= this.$route.params.id,
          axios.defaults.headers.get['header-name'] = 'value';
      axios.defaults.headers.get['Access-Control-Allow-Origin'] = '*';
      axios.get(process.env.VUE_APP_API_URL + '/sub-categories-items?id='+self.id+'&&token='+self.token)
          .then(function (response) {
            console.log(response);
            self.sub_categories = response.data.categories;
            self.items = response.data.items;
          })
          .catch(function (error) {
            console.log(error);
          });
    },
    updateData()
    {
      const self = this;
      self.sub_categories = [];
      self.items = [];
      self.getData();
    }
  },
  setup() {
    // onMounted(() => {
    //   setCurrentPageTitle("Menu");
    // });
  },
});
</script>
