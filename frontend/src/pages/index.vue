<script setup lang="ts">
import { useTaskStore } from '@/stores/tasks';
import { Task } from "../plugins/utils/types";

const taskStore = useTaskStore();
const tasks = ref(taskStore.tasks);

const updateTask = (task: Task) => {
  taskStore.updateTask(task);
};

const deleteTask = (taskId: any) => {
  taskStore.deleteTask(taskId);
};

onMounted(() => {
  taskStore.fetchTasks();
});

watch(() => taskStore.tasks,
  (newTasks) => {
    tasks.value = newTasks;
  }
);
</script>
<template>
  <VCard class="pt-6">

    <VCardText class="text-center mt-5">
      <h4 class="text-h2 mb-2">
        Lista de Tareas
      </h4>
    </VCardText>

    <VCardText class="mb-16 mt-2">
      <VRow>
        <VCol cols="12" md="10" class="mx-auto">
          <VTable v-if="tasks.length > 0" class="text-no-wrap border rounded">
            <!-- 👉 Table head -->
            <thead>
              <tr>
                <th scope="col" class="py-4">
                  <h6 class="text-sm font-weight-medium mb-1">
                    Nombre
                  </h6>
                </th>
                <th scope="col" class="py-4">
                  <h6 class="text-sm font-weight-medium mb-1">
                    ¿Completada?
                  </h6>
                </th>
                <th scope="col" class="py-4">
                  <h6 class="text-sm font-weight-medium mb-1">
                    Eliminar
                  </h6>
                </th>
              </tr>
            </thead>
            <!-- 👉 Table Body -->
            <tbody>
              <tr v-for="task in tasks" :key="task.id">
                <td>{{ task.name }}</td>
                <td>
                  <VCheckbox v-model="task.status" @change="updateTask(task)" />
                </td>
                <td>
                  <VBtn @click="deleteTask(task.id)" color="error">Borrar</VBtn>
                </td>
              </tr>
            </tbody>

          </VTable>
          <h4 v-else class="text-danger text-center">No hay registros que mostrar</h4>
        </VCol>
      </VRow>
    </VCardText>

  </VCard>
</template>

