import { mount } from "@vue/test-utils";
import Tasks from "../../src/pages/index.vue";

jest.mock("../src/stores/tasks", () => ({
  useTaskStore: jest.fn(),
}));

describe("Tasks", () => {
  let wrapper;
  const mockTasks = [
    { id: 1, name: "Task 1", status: false },
    { id: 2, name: "Task 2", status: true },
  ];
  const mockTaskStore = {
    tasks: mockTasks,
    fetchTasks: jest.fn(),
    updateTask: jest.fn(),
    deleteTask: jest.fn(),
  };
  TaskStore.useTaskStore.mockReturnValue(mockTaskStore);

  beforeEach(() => {
    wrapper = mount(Tasks);
  });

  it("fetches tasks on mount", () => {
    expect(mockTaskStore.fetchTasks).toHaveBeenCalled();
  });

  it("renders the correct number of tasks", () => {
    expect(wrapper.findAll("tr").length).toBe(mockTasks.length + 1); // tasks + 1 header row
  });

  it("updates task status on checkbox change", async () => {
    const checkbox = wrapper.find("VCheckbox");
    await checkbox.trigger("change");
    expect(mockTaskStore.updateTask).toHaveBeenCalledWith(mockTasks[0]);
  });

  it("deletes a task on button click", async () => {
    const button = wrapper.find("VBtn");
    await button.trigger("click");
    expect(mockTaskStore.deleteTask).toHaveBeenCalledWith(mockTasks[0].id);
  });
});
