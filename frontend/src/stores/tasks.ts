import axios from "axios";
import { defineStore } from "pinia";
import { Task } from "./../plugins/utils/types.d";

const API_URL = import.meta.env.VITE_API_URL;

export const useTaskStore = defineStore({
  id: "task",
  state: () => ({
    tasks: [] as Task[],
  }),
  actions: {
    async fetchTasks() {
      try {
        const {
          data: { resp },
        } = await axios.get(`${API_URL}tasks`);
        this.tasks = resp;
        return true;
      } catch (e: unknown) {
        console.error(e);
        return false;
      }
    },

    async addTask(task: Task) {
      try {
        const {
          data: { resp: newTask },
        } = await axios.post(`${API_URL}tasks`, task);
        this.tasks.push(newTask);
      } catch (e: unknown) {
        console.error(e);
        return false;
      }
    },

    async updateTask(task: Task) {
      try {
        await axios.put(`${API_URL}tasks/${task.id}`, task);
        // Update the task directly in the state instead of fetching all tasks.
        const taskIndex = this.tasks.findIndex((t) => t.id === task.id);
        this.tasks[taskIndex] = task;
        return true;
      } catch (e: unknown) {
        console.error(e);
        return false;
      }
    },

    async deleteTask(taskId: number) {
      try {
        await axios.delete(`${API_URL}tasks/${taskId}`);
        // Remove the task directly from the state instead of fetching all tasks.
        this.tasks = this.tasks.filter((t) => t.id !== taskId);
        return true;
      } catch (e: unknown) {
        console.error(e);
        return false;
      }
    },
  },
});
