@extends('layouts.app')

@section('title', 'Goals')

@section('content')
<div class="container">
    <h1 class="mb-4">Goals Management</h1>

    <!-- Tombol Tambah Goals -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGoalModal">
        Add Goal
    </button>

    <!-- Tabel Goals -->
    <table class="table mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Goal</th>
                <th>Completed</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($goals as $goal)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $goal->goals }}</td>
                    <td>
                        <input type="checkbox" class="form-check-input" {{ $goal->is_completed ? 'checked' : '' }}
                            onchange="toggleGoal({{ $goal->id }}, this.checked)">
                    </td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editGoalModal"
                            data-id="{{ $goal->id }}" data-goal="{{ $goal->goals }}">
                            Update
                        </button>

                        <form action="{{ route('goals.destroy', $goal->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Delete this goal?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No goals available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Modal: Add Goal -->
<div class="modal fade" id="addGoalModal" tabindex="-1" aria-labelledby="addGoalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('goals.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Goal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="goal" class="form-control" placeholder="Enter your goal" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add Goal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Edit Goal -->
<div class="modal fade" id="editGoalModal" tabindex="-1" aria-labelledby="editGoalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editGoalForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Goal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="editGoal" name="goal" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Handle Edit Modal
    const editGoalModal = document.getElementById('editGoalModal');
    editGoalModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const goalId = button.getAttribute('data-id');
        const goalText = button.getAttribute('data-goal');

        const form = document.getElementById('editGoalForm');
        form.action = `/goals/${goalId}`;
        document.getElementById('editGoal').value = goalText;
    });

    function toggleGoal(goalId, isCompleted) {
        fetch(`/goals/${goalId}/toggle`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ is_completed: isCompleted }),
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to update status.');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    console.log('Goal status updated successfully.');
                }
            })
            .catch(error => {
                alert(error.message);
            });
    }

</script>
@endsection
