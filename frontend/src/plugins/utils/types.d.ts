export interface Task {
  id?: number;
  name: string;
  status?: boolean;
  created_at?: string;
  updated_at?: string;
}

export interface TaskResponse extends Task {
  tasks?: Task;
  status: number;
  message?: string;
}
