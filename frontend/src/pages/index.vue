
<script lang="ts" setup>
import { requiredValidator } from '@validators';
import axios from "axios";
import type { VForm } from 'vuetify/components/VForm';

const name = ref('')
const description = ref('')
const quantity = ref<number>()
const price = ref<number>()
const form = ref<VForm>()
const router = useRouter()

const register = async () => {
  try {
    const { data } = await axios.post(`${import.meta.env.VITE_API_URL}products`, {
      name: name.value,
      description: description.value,
      quantity: quantity.value,
      price: price.value
    });
    router.push('stock');
  } catch (e: any) {
    console.error(e)
  }
}

const onSubmit = () => {
  form.value?.validate()
    .then(({ valid: isValid }) => {
      if (isValid) register()
    })
}
</script>

<template>
  <VCard class="mb-6 m-auto justify-center" title="Nuevo producto 🚀">
    <VForm ref="form" lazy-validation @submit.prevent="onSubmit">
      <VRow align-content="center" class="ml-16">
        <VCol cols="8">
          <VRow no-gutters>
            <!-- 👉 First Name -->
            <VCol cols="12" md="3" class="d-flex align-items-center">
              <label class="v-label text-body-2 text-high-emphasis" for="name">Nombre</label>
            </VCol>

            <VCol cols="12" md="9">
              <AppTextField id="name" autofocus v-model="name" :rules="[requiredValidator]" required
                placeholder="Ej: Mentol " />
            </VCol>
          </VRow>
        </VCol>

        <VCol cols="8">
          <VRow no-gutters>
            <!-- 👉 First Name -->
            <VCol cols="12" md="3" class="d-flex align-items-center">
              <label class="v-label text-body-2 text-high-emphasis" for="description">Descripción</label>
            </VCol>

            <VCol cols="12" md="9">
              <AppTextField id="description" v-model="description" :rules="[requiredValidator]" required
                placeholder="Ej: Producto de alta duración" persistent-placeholder />
            </VCol>
          </VRow>
        </VCol>

        <VCol cols="8">
          <VRow no-gutters>
            <!-- 👉 First Name -->
            <VCol cols="12" md="3" class="d-flex align-items-center">
              <label class="v-label text-body-2 text-high-emphasis" for="quantity">Cantidad</label>
            </VCol>

            <VCol cols="12" md="9">
              <AppTextField id="quantity" type="number" v-model="quantity" :rules="[requiredValidator]" required
                placeholder="Ej: 3" persistent-placeholder />
            </VCol>
          </VRow>
        </VCol>

        <VCol cols="8">
          <VRow no-gutters>
            <!-- 👉 First Name -->
            <VCol cols="12" md="3" class="d-flex align-items-center">
              <label class="v-label text-body-2 text-high-emphasis" for="price">Precio</label>
            </VCol>

            <VCol cols="12" md="9">
              <AppTextField id="price" type="number" v-model="price" :rules="[requiredValidator]" required
                placeholder="Ej: 30" persistent-placeholder />
            </VCol>
          </VRow>
        </VCol>

        <!-- 👉 submit and reset button -->
        <VCol offset-md="3" cols="12" md="9" class="d-flex gap-4 mb-6">
          <VBtn type="submit">
            Procesar
          </VBtn>
          <VBtn color="secondary" variant="tonal" type="reset">
            Borrar
          </VBtn>
        </VCol>

      </VRow>
    </VForm>
  </VCard>
</template>

