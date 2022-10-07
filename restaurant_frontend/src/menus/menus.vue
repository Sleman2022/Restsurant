<template>
  <!--begin::Modal - edit Menu-->
  <div
      class="modal"
      id="EditMenuModal"
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
              @click="getUsers(); getMenus();"
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
              :model="editMenu"
              class="form"
          >
            <!--begin::Heading-->
            <div class="mb-13 text-center">
              <!--begin::Title-->
              <h1 class="mb-3">Edit Menu</h1>
              <!--end::Title-->
            </div>
            <!--end::Heading-->
            <!--begin::Input group-->
            <div class="d-flex flex-column mb-8 fv-row">
              <!--begin::Label-->
              <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                <span class="">Menu Name</span>
              </label>
              <!--end::Label-->
              <el-form-item prop="name">
                <el-input
                    v-model="editMenu.name"
                    placeholder="Enter Menu Name"
                    name="name"
                ></el-input>
              </el-form-item>
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="d-flex flex-column mb-8 fv-row">
              <!--begin::Label-->
              <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                <span>Users</span>
              </label>
              <!--end::Label-->

              <el-form-item prop="users">
                <el-select
                    v-model = "editMenu.users"
                    multiple
                    filterable
                    allow-create
                    default-first-option
                    placeholder="Choose user for your menu"
                >
                  <el-option v-for="(user, index) in editUsers" :key="index" :label=user.name :value=user.id> </el-option>
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
  <!--end::Modal - New Target-->
  <NewMenuModal @submit="getUsers(); getMenus();" :users=my_users.data></NewMenuModal>
  <div class="card mb-5 mb-xl-8">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
      <h3 class="card-title align-items-start flex-column">
        <span class="card-label fw-bolder fs-3 mb-1">Menus</span>
      </h3>

      <div
          v-if="role==1"
          class="card-toolbar"
          data-bs-toggle="tooltip"
          data-bs-placement="top"
          data-bs-trigger="hover"
          title="New Menu"
      >
        <a
            class="btn btn-sm btn-light-primary"
            data-bs-toggle="modal"
            data-bs-target="#NewMenuModal"
        >
          <span class="svg-icon svg-icon-3">
            <inline-svg src="media/icons/duotune/arrows/arr075.svg" />
          </span>
          New Menu
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
            <th class="min-w-120px">Users</th>
            <th class="min-w-100px text-end">Categories</th>
            <th class="min-w-100px text-end" v-if="role==1">Actions</th>
          </tr>
          </thead>
          <!--end::Table head-->

          <!--begin::Table body-->
          <tbody>
          <template v-for="(menu, index) in menus.data" :key="index">
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <div class="d-flex justify-content-start flex-column">
                    <a
                        class="text-dark fw-bolder text-hover-primary fs-6"
                    >{{ menu.name }}</a
                    >
                  </div>
                </div>
              </td>

              <td v-if="role==1">
                <a
                    class="text-danger fw-bolder text-hover-primary d-block fs-6" v-if="menu.discount">
                  {{ menu.discount }}%
                </a>
                <a
                   class="text-danger fw-bolder text-hover-primary d-block fs-6" v-if="!menu.discount">
                  0%
                </a>
              </td>
              <td v-if="role==2">
                <el-input
                    v-model="menu.discount"
                    @change="changeDiscount(menu)"
                    placeholder="Enter Menu Name"
                    name="discount"
                    :value="menu.discount"
                    style="width:auto;"
                ></el-input>%
              </td>
              <td>
              <a
                 class="text-dark fw-bolder text-hover-primary d-block fs-6">
                <div  v-for="(user, index2) in menu.users" :key="index2">
                  <span class="fw-bold d-block fs-7">{{user.name}}</span>
                </div>
              </a>
              </td>

              <td>

              </td>
              <td class="text-end" v-if="role==1">
                <button
                    class="btn btn-sm btn-outline-info"
                    data-bs-toggle="modal"
                    data-bs-target="#EditMenuModal"
                    @click="editMenuChange(menu)" v-if="menu.id != 1"
                >
                <span class="indicator-label">
                  edit
                </span>
                </button>
                <button
                    class="btn btn-sm btn-outline-danger"
                    v-if="menu.id != 1"
                    @click="deleteMenu(menu.id)"
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
  <el-pagination v-if="menus.meta"
                 v-model:current-page="menus.meta.current_page"
                 @current-change="getMenus"
                 :page-size="menus.meta.per_page"
                 layout="prev, pager, next"
                 :total="menus.meta.total"
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
import NewMenuModal from "@/components/modals/menu/NewMenuModal.vue";
export default defineComponent(
    {
      name: "menus-listing",
      props: {
      },
      components: {
        NewMenuModal,
      },
      data: function() {
        return {
          my_users : [],
          menus : [],
          editUsers : [1],
          editMenu : {},
          page: 1,
          role:0,
        }
      },
      mounted() {
        this.getUsers();
        this.getMenus();

        const store = useStore();
        if(store.getters.userRole == 'admin') {
          this.role = 1;
        }
        if(store.getters.userRole == 'restaurant admin') {
          this.role = 2;
        }
      },
      methods: {
        getUsers()
        {
          const self = this;
          axios.defaults.headers.get['header-name'] = 'value';
          axios.defaults.headers.get['Access-Control-Allow-Origin'] = '*';
          axios.get(process.env.VUE_APP_API_URL + '/no-menu-users')
              .then(function (response) {
                self.my_users = response.data;
                self.editMenu = {};
              })
              .catch(function (error) {
                console.log(error);
              });
        },
        getMenus(page = 1)
        {
          const self = this;
          axios.defaults.headers.get['header-name'] = 'value';
          axios.defaults.headers.get['Access-Control-Allow-Origin'] = '*';
          axios.get(process.env.VUE_APP_API_URL + '/menus?page=' + page)
              .then(function (response) {
                self.menus = response.data;
                self.page = page;
              })
              .catch(function (error) {
                console.log(error);
              });
        },
        deleteMenu(menu_id)
        {
          const self = this;
          axios.defaults.headers.get['header-name'] = 'value';
          axios.defaults.headers.get['Access-Control-Allow-Origin'] = '*';
          axios.delete(process.env.VUE_APP_API_URL + '/delete-menu/'+menu_id)
              .then(function (response) {
               self.getUsers();
               self.getMenus();
              })
              .catch(function (error) {
                console.log(error);
              });
        },
        editMenuChange(menu)
        {
          const self = this;
          self.editMenu = menu;
          self.editUsers = [];
          for (let i = 0; i < self.my_users['data'].length; i++)
          {
            self.editUsers.push(self.my_users['data'][i]);
          }
          for (let j = 0; j < self.editMenu['users'].length; j++)
          {
            if(self.editMenu['users'][j])
            {
              self.editUsers.push(self.editMenu['users'][j]);
            }
          }
        },
        editSubmit() {
          const self = this;
          axios.defaults.headers.get['header-name'] = 'value';
          axios.defaults.headers.get['Access-Control-Allow-Origin'] = '*';
          axios.put(process.env.VUE_APP_API_URL + '/edit-menu/' + '8', self.editMenu)
              .then(function (response) {
                self.getUsers();
                self.getMenus();
                Swal.fire({
                  text: "Menu has been updated successfully",
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
        changeDiscount(menu)
        {
          const self = this;
          axios.defaults.headers.get['header-name'] = 'value';
          axios.defaults.headers.get['Access-Control-Allow-Origin'] = '*';
          axios.put(process.env.VUE_APP_API_URL + '/change-menu-discount/'+ menu.id,menu)
              .then(function (response) {
                self.getUsers();
                self.getMenus();
              }).catch(function (error) {
                   console.log(error);
            });
        }
      },
    });
</script>
