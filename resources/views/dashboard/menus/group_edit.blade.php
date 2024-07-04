@extends('dashboard.layouts.main')

@section('container')

<h1 class="h2">Edit Ingredients for "{{ $menu->nama }}"</h1>

<div class="col-lg-8">
  <form method="post" action="/dashboard/ingredientmenus/{{$menu->id}}" class="mb-5" enctype="multipart/form-data">
    {{-- <form method="post" action="{{ route('menuGroup', ['menu' => $menu]) }}" class="mb-5"
      enctype="multipart/form-data"> --}}
      @csrf

      <div id="ingredients-container">
        <!-- Ingredient dropdown fields will be added here -->
      </div>

      <button type="button" id="add-ingredient-btn" class="btn btn-primary">Add Ingredient</button>
      <button type="submit" class="btn btn-success">Save Ingredients for Menu</button>
    </form>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('ingredients-container');
    const addButton = document.getElementById('add-ingredient-btn');
    let ingredientCount = 0;

    addButton.addEventListener('click', function() {
      ingredientCount++;

      const newIngredientField = `
        <div class="mb-3">
          <label for="ingredient_id_${ingredientCount}" class="form-label">Ingredient ${ingredientCount}</label>
          <select class="form-control" id="ingredient_id_${ingredientCount}" name="ingredients[${ingredientCount}][ingredient_id]" required>
            <option value="">Select Ingredient</option>
            @foreach($ingredients as $ingredient)
              <option value="{{ $ingredient->id }}">{{ $ingredient->nama }}</option>
            @endforeach
          </select>
          <input type="number" step="0.01" class="form-control" id="amount_${ingredientCount}" name="ingredients[${ingredientCount}][amount]" required placeholder="Enter value">
        </div>
      `;

      container.insertAdjacentHTML('beforeend', newIngredientField);
    });
  });
</script>


@endsection