<template>
  <!--begin::Modal - edit Category-->
  <div
      class="modal"
      id="EditCategoryModal"
      tabindex="-1"
      aria-hidden="true"
  >
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
      <!--begin::Modal content-->
      <div class="modal-content rounded">
        <!--begin::Modal header-->
        <div class="modal-header pb-0 border-0 justify-content-end">
          <!--begin::Close-->
          <div
              class="btn btn-sm btn-icon btn-active-color-primary"
              data-bs-dismiss="modal"
              @click="getCategories();"
          >
            <span class="svg-icon svg-icon-1">
              <inline-svg src="media/icons/duotune/arrows/arr061.svg" />
            </span>
          </div>
          <!--end::Close-->
        </div>
        <!--begin::Modal header-->

        <!--begin::Modal body-->
        <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
          <!--begin:Form-->
          <el-form
              id="modal_edit_menu_form"
              @submit.prevent="editsubmit()"
              :model="editCategory"
              class="form"
          >
            <!--begin::Heading-->
            <div class="mb-13 text-center">
              <!--begin::Title-->
              <h1 class="mb-3">Edit Category</h1>
              <!--end::Title-->
            </div>
            <!--end::Heading-->
            <!--begin::Input group-->
            <div class="d-flex flex-column mb-8 fv-row">
              <!--begin::Label-->
              <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                <span class="">Category Name</span>
              </label>
              <!--end::Label-->
              <el-form-item prop="name">
                <el-input
                    v-model="editCategory.name"
                    placeholder="Enter Category Name"
                    name="name"
                ></el-input>
              </el-form-item>
            </div>
            <!--end::Input group-->
            <!--begin::Actions-->
            <div class="text-center">
              <!--begin::Button-->
              <button
                  class="btn btn-lg btn-primary"
                  type="submit"
                  data-bs-dismiss="modal"
                  @click="editSubmit()"
              >
                <span class="indicator-label">
                  Submit
                  <span class="svg-icon svg-icon-3 ms-2 me-0">
                    <inline-svg src="icons/duotune/arrows/arr064.svg" />
                  </span>
                </span>
              </button>
              <!--end::Button-->
            </div>
            <!--end::Actions-->
          </el-form>
          <!--end:Form-->
        </div>
        <!--end::Modal body-->
      </div>
      <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
  </div>
  <!--end::Modal - New Target-->
  <NewCategoryModal @submit="getCategories(); getParentCategories();" :categories=parent_category.data></NewCategoryModal>
  <div class="card mb-5 mb-xl-8">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
      <h3 class="card-title align-items-start flex-column">
        <span class="card-label fw-bolder fs-3 mb-1">Categories</span>
      </h3>

      <div
          v-if="role==1"
          class="card-toolbar"
          data-bs-toggle="tooltip"
          data-bs-placement="top"
          data-bs-trigger="hover"
          title="New Category"
      >
        <a
            class="btn btn-sm btn-light-primary"
            data-bs-toggle="modal"
            data-bs-target="#NewCategoryModal"
        >
          <span class="svg-icon svg-icon-3">
            <inline-svg src="media/icons/duotune/arrows/arr075.svg" />
          </span>
          New Category
        </a>
      </div>
    </div>
    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body py-3">
      <!--begin::Table container-->
      <div class="table-responsive">
        <!--begin::Table-->
        <table
            class="
            table table-row-dashed table-row-gray-300
            align-middle
            gs-0
            gy-4
          "
        >
          <!--begin::Table head-->
          <thead>
          <tr class="fw-bolder text-muted">
            <th class="min-w-150px">Name</th>
            <th class="min-w-140px">Discount</th>
            <th class="min-w-120px">Parent</th>
            <th class="min-w-100px text-end" v-if="role==1">Actions</th>
          </tr>
          </thead>
          <!--end::Table head-->

          <!--begin::Table body-->
          <tbody>
          <template v-for="(category, index) in categories.data" :key="index">
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <div class="d-flex justify-content-start flex-column">
                    <a
                        class="text-dark fw-bolder text-hover-primary fs-6"
                    >{{ category.name }}</a
                    >
                  </div>
                </div>
              </td>

              <td v-if="role==1">
                <a
                    class="text-danger fw-bolder text-hover-primary d-block fs-6" v-if="category.discount">
                  {{ category.discount }}%
                </a>
                <a
                    class="text-danger fw-bolder text-hover-primary d-block fs-6" v-if="!category.discount">
                  0%
                </a>
              </td>
              <td v-if="role==2">
                <el-input
                    v-model="category.discount"
                    @change="changeDiscount(category)"
                    placeholder="Enter Menu Name"
                    name="discount"
                    :value="category.discount"
                    style="width:auto;"
                ></el-input>%
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="d-flex justify-content-start flex-column">
                    <a
                        class="text-dark fw-bolder text-hover-primary fs-6"
                    >{{category.parent_name}}</a
                    >
                  </div>
                </div>
              </td>

              <td>

              </td>
              <td class="text-end" v-if="role==1">
                <button
                    class="btn btn-sm btn-outline-info"
                    data-bs-toggle="modal"
                    data-bs-target="#EditCategoryModal"
                    @click="editCategoryChange(category)"
                >
                <span class="indicator-label">
                  edit
                </span>
                </button>
                <button
                    class="btn btn-sm btn-outline-danger"
                    @click="deleteCategory(category.id)"
                >
                <span class="indicator-label">
                  delete
                </span>
                </button>
              </td>
            </tr>
          </template>
          </tbody>
          <!--end::Table body-->
        </table>
        <!--end::Table-->
      </div>
      <!--end::Table container-->
    </div>
    <!--begin::Body-->
  </div>
  <el-pagination v-if="categories.meta"
                 v-model:current-page="categories.meta.current_page"
                 @current-change="getCategories"
                 :page-size="categories.meta.per_page"
                 layout="prev, pager, next"
                 :total="categories.meta.total"
                 :hide-on-single-page="true"
                 background
  >
  </el-pagination>
</template>
<script lang="ts">
import {defineComponent, ref} from "vue";
import axios from "axios";
import {useStore} from "vuex";
import Swal from "sweetalert2/dist/sweetalert2.js";
import NewCategoryModal from "@/components/modals/category/NewCategoryModal.vue";
export default defineComponent(
    {
      name: "categories-listing",
      props: {
      },
      components: {
          NewCategoryModal,
      },
      data: function() {
        return {
          parent_category : [],
          categories : [],
          editCategory : {},
          page: 1,
          role:0,
        }
      },
      mounted() {
        this.getParentCategories();
        this.getCategories();

        const store = useStore();
        if(store.getters.userRole == 'admin') {
          this.role = 1;
        }
        if(store.getters.userRole == 'restaurant admin') {
          this.role = 2;
        }
      },
      methods: {
        getParentCategories()
        {
          const self = this;
          axios.defaults.headers.get['header-name'] = 'value';
          axios.defaults.headers.get['Access-Control-Allow-Origin'] = '*';
          axios.get(process.env.VUE_APP_API_URL + '/parent-categories')
              .then(function (response) {
                self.parent_category = response.data;
              })
              .catch(function (error) {
                console.log(error);
              });
        },
        getCategories(page = 1)
        {
          const self = this;
          axios.defaults.headers.get['header-name'] = 'value';
          axios.defaults.headers.get['Access-Control-Allow-Origin'] = '*';
          axios.get(process.env.VUE_APP_API_URL + '/categories?page=' + page)
              .then(function (response) {
                self.categories = response.data;
                self.page = page;
              })
              .catch(function (error) {
                console.log(error);
              });
        },
        deleteCategory(category_id)
        {
          const self = this;
          axios.defaults.headers.get['header-name'] = 'value';
          axios.defaults.headers.get['Access-Control-Allow-Origin'] = '*';
          axios.delete(process.env.VUE_APP_API_URL + '/delete-category/'+category_id)
              .then(function (response) {
                self.getCategories();
                self.getParentCategories();
              })
              .catch(function (error) {
                console.log(error);
              });
        },
        editCategoryChange(category)
        {
          const self = this;
          self.editCategory = category;
        },
        editSubmit() {
          const self = this;
          axios.defaults.headers.get['header-name'] = 'value';
          axios.defaults.headers.get['Access-Control-Allow-Origin'] = '*';
          axios.put(process.env.VUE_APP_API_URL + '/edit-category/' + '8', self.editCategory)
              .then(function (response) {
                self.getCategories();
                self.getParentCategories();
                Swal.fire({
                  text: "Category has been updated successfully",
                  icon: "success",
                  buttonsStyling: false,
                  confirmButtonText: "Ok, got it!",
                  customClass: {
                    confirmButton: "btn btn-primary",
                  },
                })
              }).catch(function (error) {
            Swal.fire({
              text: "Sorry, looks like there are some errors detected, please try again.",
              icon: "error",
              buttonsStyling: false,
              confirmButtonText: "Ok, got it!",
              customClass: {
                confirmButton: "btn btn-primary",
              },
            });
          });
        },
        changeDiscount(category)
        {
          const self = this;
          axios.defaults.headers.get['header-name'] = 'value';
          axios.defaults.headers.get['Access-Control-Allow-Origin'] = '*';
          axios.put(process.env.VUE_APP_API_URL + '/change-category-discount/'+ category.id,category)
              .then(function (response) {
                self.getCategories();
              }).catch(function (error) {
            console.log(error);
          });
        }
      },
    });
</script>
