<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a href="#maindata" class="nav-link active" role="tab" data-toggle="tab">Base Data</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-3">
                        <div class="tab-pane active" id="maindata" rele="tabpanel">
                            <div class="form-group">
                                <label for="title">Header</label>
                                <input  type="text" value="{{ old('title', $item->title) }}"
                                        name="title"
                                        id="title"
                                        class="form-control"
                                        required>
                            </div>

                            <div class="form-group">
                                <label for="slug">Identifier</label>
                                <input  type="text" value="{{ old('slug', $item->slug) }}"
                                        name="slug"
                                        id="slug"
                                        class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="parent_id">Parent</label>
                                <select name="parent_id"
                                        id="parent_id"
                                        class="form-control"
                                        placeholder="Choose Category"
                                        required>
                                    @foreach($categoryList as $categoryOption)
                                        <option value="{{ $categoryOption->id }}"
                                            @if($categoryOption->id == $item->parent_id) selected @endif>
                                            {{ $categoryOption->id }}. {{ $categoryOption->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea   rows="3"
                                            name="description"
                                            id="description"
                                            class="form-control">{{ old('description', $item->description) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
