<template>
  <!--begin::Modal - New Menu-->
  <div
      class="modal fade"
      id="NewMenuModal"
      ref="newMenuModalRef"
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
              id="modal_new_menu_form"
              @submit.prevent="submit()"
              :model="menuData"
              :rules="rules"
              ref="formRef"
              class="form"
          >
            <!--begin::Heading-->
            <div class="mb-13 text-center">
              <!--begin::Title-->
              <h1 class="mb-3">New Menu</h1>
              <!--end::Title-->
            </div>
            <!--end::Heading-->

            <!--begin::Input group-->
            <div class="d-flex flex-column mb-8 fv-row">
              <!--begin::Label-->
              <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                <span class="required">Menu Name</span>
              </label>
              <!--end::Label-->

              <el-form-item prop="name">
                <el-input
                    v-model="menuData.name"
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
                    v-model="menuData.users"
                    multiple
                    filterable
                    allow-create
                    default-first-option
                    placeholder="Choose user for your menu"
                >
                  <el-option v-for="(user, index) in users" :key="index" :label=user.name :value=user.id> </el-option>
                </el-select>
              </el-form-item>
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="d-flex flex-column mb-8 fv-row">
              <!--begin::Label-->
              <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                <span>Categories</span>
              </label>
              <!--end::Label-->

              <el-form-item prop="categories">
                <el-select
                    v-model="menuData.categories"
                    multiple
                    filterable
                    allow-create
                    default-first-option
                    placeholder="Choose Category for your menu"
                >
                  <el-option v-for="(category, index) in categories" :key="index" :label=category.name :value=category.id> </el-option>
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
</template>

<style lang="scss">
.el-select {
  width: 100%;
}
</style>

<script lang="ts">
import { defineComponent, ref } from "vue";
import { hideModal } from "@/core/helpers/dom";
import Swal from "sweetalert2/dist/sweetalert2.js";
import axios from "axios";

interface NewAddressData {
  name: string;
  users: Array<string>;
  categories: Array<string>;
}

export default defineComponent({
  name: "new-menu-modal",
  props: {
    users: Array,
    categories: Array,
  },
  components: {},
  setup() {
    const formRef = ref<null | HTMLFormElement>(null);
    const newMenuModalRef = ref<null | HTMLElement>(null);
    const loading = ref<boolean>(false);

    const menuData = ref<NewAddressData>({
      name: "",
      users: [],
      categories: [],
    });

    const rules = ref({
      name: [
        {
          required: true,
          message: "Please input menu name",
          trigger: "blur",
        },
      ],
    });

    const submit = () => {
      if (!formRef.value) {
        return;
      }

      formRef.value.validate((valid) => {
        if (valid) {
          loading.value = true;
          axios.defaults.headers.get['header-name'] = 'value';
          axios.defaults.headers.get['Access-Control-Allow-Origin'] = '*';
          axios.post(process.env.VUE_APP_API_URL + '/new-menu',menuData.value)
              .then(function (response) {
                hideModal(newMenuModalRef.value);
                Swal.fire({
                  text: "Menu has been added successfully",
                  icon: "success",
                  buttonsStyling: false,
                  confirmButtonText: "Ok, got it!",
                  customClass: {
                    confirmButton: "btn btn-primary",
                  },
                })
              }).catch(function (error) {
                      hideModal(newMenuModalRef.value);
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
          //
        } else {
          Swal.fire({
            text: "Sorry, looks like there are some errors detected, please try again.",
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
              confirmButton: "btn btn-primary",
            },
          });
          return false;
        }
      });
    };

    return {
      menuData,
      submit,
      loading,
      formRef,
      rules,
      newMenuModalRef,
    };
  },
});
</script>
