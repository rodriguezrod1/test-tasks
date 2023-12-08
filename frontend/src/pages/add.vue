
<script lang="ts" setup>
import { useTaskStore } from '@/stores/tasks';
import { requiredValidator } from '@validators';
import type { VForm } from 'vuetify/components/VForm';

const taskStore = useTaskStore();
const name = ref('')
const form = ref<VForm>()
const router = useRouter()

const register = async () => {
  taskStore.addTask({ name: name.value })
  router.push('/');
}

const onSubmit = () => {
  form.value?.validate()
    .then(({ valid: isValid }) => {
      if (isValid) register()
    })
}
</script>

<template>
  <VCard class="mb-6 m-auto justify-center" title="Nueva Tarea 🚀">
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
                placeholder="Ej: Hacer los dulces " />
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

