<template>
  <!--begin::Modal - edit Item-->
  <div
      class="modal"
      id="EditItemModal"
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
              @click="getItems();"
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
              @submit.prevent= "editsubmit()"
              :model="editItem"
              class="form"
          >
            <!--begin::Heading-->
            <div class="mb-13 text-center">
              <!--begin::Title-->
              <h1 class="mb-3">Edit Item</h1>
              <!--end::Title-->
            </div>
            <!--end::Heading-->
            <!--begin::Input group-->
            <div class="d-flex flex-column mb-8 fv-row">
              <!--begin::Label-->
              <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                <span class="required">Item Name</span>
              </label>
              <!--end::Label-->
              <el-form-item prop="name">
                <el-input
                    v-model="editItem.name"
                    required
                    placeholder="Enter Item Name"
                    name="name"
                ></el-input>
              </el-form-item>
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="d-flex flex-column mb-8 fv-row">
              <!--begin::Label-->
              <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                <span class="required">Item Price</span>
              </label>
              <!--end::Label-->
              <el-form-item prop="price">
                <el-input
                    v-model="editItem.price"
                    type="number"
                    placeholder="Enter Item Price"
                    required
                    name="price"
                ></el-input>
              </el-form-item>
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="d-flex flex-column mb-8 fv-row">
              <!--begin::Label-->
              <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                <span class="required">Parent</span>
              </label>
              <!--end::Label-->

              <el-form-item prop="parent_id">
                <el-select
                    v-model="editItem.parent_id"
                    filterable
                    allow-create
                    default-first-option
                    placeholder="Choose Parent"
                    required
                    name="parent_id"
                >
                  <el-option v-for="(category, index) in leaf_category.data" :key="index" :label=category.name :value=category.id> </el-option>
                </el-select>
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
<!--  end::Modal - New Item-->
  <NewItemModal @submit="getItems(); getLeafCategories();" :categories=leaf_category.data></NewItemModal>
  <div class="card mb-5 mb-xl-8">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
      <h3 class="card-title align-items-start flex-column">
        <span class="card-label fw-bolder fs-3 mb-1">Items</span>
      </h3>

      <div
          v-if="role==1"
          class="card-toolbar"
          data-bs-toggle="tooltip"
          data-bs-placement="top"
          data-bs-trigger="hover"
          title="New Item"
      >
        <a
            class="btn btn-sm btn-light-primary"
            data-bs-toggle="modal"
            data-bs-target="#NewItemModal"
        >
          <span class="svg-icon svg-icon-3">
            <inline-svg src="media/icons/duotune/arrows/arr075.svg" />
          </span>
          New Item
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
            <th class="min-w-140px">Price</th>
            <th class="min-w-140px">Discount</th>
            <th class="min-w-120px">Parent</th>
            <th class="min-w-100px text-end" v-if="role==1">Actions</th>
          </tr>
          </thead>
          <!--end::Table head-->

          <!--begin::Table body-->
          <tbody>
          <template v-for="(item, index) in items.data" :key="index">
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <div class="d-flex justify-content-start flex-column">
                    <a
                        class="text-dark fw-bolder text-hover-primary fs-6"
                    >{{ item.name }}</a
                    >
                  </div>
                </div>
              </td>

              <td>
                <div class="d-flex align-items-center">
                  <div class="d-flex justify-content-start flex-column">
                    <a
                        class="text-dark fw-bolder text-hover-primary fs-6"
                    >{{ item.price }}</a
                    >
                  </div>
                </div>
              </td>

              <td v-if="role==1">
                <a
                    class="text-danger fw-bolder text-hover-primary d-block fs-6" v-if="item.discount">
                  {{ item.discount }}%
                </a>
                <a
                    class="text-danger fw-bolder text-hover-primary d-block fs-6" v-if="!item.discount">
                  0%
                </a>
              </td>
              <td v-if="role==2">
                <el-input
                    v-model="item.discount"
                    @change="changeDiscount(item)"
                    placeholder="Enter Discount"
                    name="discount"
                    :value="item.discount"
                    style="width:auto;"
                ></el-input>%
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="d-flex justify-content-start flex-column">
                    <a
                        class="text-dark fw-bolder text-hover-primary fs-6"
                    >{{item.parent_name}}</a
                    >
                  </div>
                </div>
              </td>

              <td class="text-end" v-if="role==1">
                <button
                    class="btn btn-sm btn-outline-info"
                    data-bs-toggle="modal"
                    data-bs-target="#EditItemModal"
                    @click="editItemChange(item)"
                >
                <span class="indicator-label">
                  edit
                </span>
                </button>
                <button
                    class="btn btn-sm btn-outline-danger"
                    @click="deleteItem(item.id)"
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
  <el-pagination v-if="items.meta"
                 v-model:current-page="items.meta.current_page"
                 @current-change="getItems"
                 :page-size="items.meta.per_page"
                 layout="prev, pager, next"
                 :total="items.meta.total"
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
import NewItemModal from "@/components/modals/item/NewItemModal.vue";
export default defineComponent(
    {
      name: "categories-listing",
      props: {
      },
      components: {
        NewItemModal,
      },
      data: function() {
        return {
          leaf_category : [],
          items : [],
          editItem : {},
          page: 1,
          role:0,
        }
      },
      mounted() {
        this.getLeafCategories();
        this.getItems();

        const store = useStore();
        if(store.getters.userRole == 'admin') {
          this.role = 1;
        }
        if(store.getters.userRole == 'restaurant admin') {
          this.role = 2;
        }
      },
      methods: {
        getLeafCategories()
        {
          const self = this;
          axios.defaults.headers.get['header-name'] = 'value';
          axios.defaults.headers.get['Access-Control-Allow-Origin'] = '*';
          axios.get(process.env.VUE_APP_API_URL + '/leaf-categories')
              .then(function (response) {
                self.leaf_category = response.data;
              })
              .catch(function (error) {
                console.log(error);
              });
        },
        getItems(page = 1)
        {
          const self = this;
          axios.defaults.headers.get['header-name'] = 'value';
          axios.defaults.headers.get['Access-Control-Allow-Origin'] = '*';
          axios.get(process.env.VUE_APP_API_URL + '/items?page=' + page)
              .then(function (response) {
                self.items = response.data;
                self.page = page;
              })
              .catch(function (error) {
                console.log(error);
              });
        },
        deleteItem(item_id)
        {
          const self = this;
          axios.defaults.headers.get['header-name'] = 'value';
          axios.defaults.headers.get['Access-Control-Allow-Origin'] = '*';
          axios.delete(process.env.VUE_APP_API_URL + '/delete-item/'+item_id)
              .then(function (response) {
                self.getLeafCategories();
                self.getItems();
              })
              .catch(function (error) {
                console.log(error);
              });
        },
        editItemChange(item)
        {
          const self = this;
          self.editItem = item;
        },
        editSubmit() {
          const self = this;
          axios.defaults.headers.get['header-name'] = 'value';
          axios.defaults.headers.get['Access-Control-Allow-Origin'] = '*';
          axios.put(process.env.VUE_APP_API_URL + '/edit-item/' + '8', self.editItem)
              .then(function (response) {
                self.getLeafCategories();
                self.getItems();
                Swal.fire({
                  text: "Item has been updated successfully",
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
        changeDiscount(item)
        {
          const self = this;
          axios.defaults.headers.get['header-name'] = 'value';
          axios.defaults.headers.get['Access-Control-Allow-Origin'] = '*';
          axios.put(process.env.VUE_APP_API_URL + '/change-item-discount/'+ item.id,item)
              .then(function (response) {
                self.getItems();
              }).catch(function (error) {
            console.log(error);
          });
        }
      },
    });
</script>
