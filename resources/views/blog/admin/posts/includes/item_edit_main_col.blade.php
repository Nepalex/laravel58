@php /* @var \App\Models\BlogPost $item */@endphp
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                @if($item->is_published)
                    Опубликовано
                @else
                    Черновик
                @endif
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#maindata" role="tab">Основные сведения</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#adddata" role="tab">Доп. сведения</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input type="text" value="{{ old('title', $item->title) }}"
                                   class="form-control"
                                   id="title"
                                   name="title"
                                   minlength="3"
                                   required>

                        </div>
                        <div class="form-group">
                            <label for="content_raw">Статья</label>
                            <textarea class="form-control"
                                    id="content_raw"
                                    name="content_raw"
                                    rows="10">{{ old('content_raw', $item->content_raw) }}
                            </textarea>

                        </div>

                    </div>
                    <div class="tab-pane" id="adddata" role="tabpanel">
                        <div class="form-group">
                            <label for="slug">Идентификатор</label>
                            <input type="text" value="{{ $item->slug}}"
                                   class="form-control"
                                   id="slug"
                                   name="slug">

                        </div>
                        <div class="form-group">
                            <label for="category_id">Выбор категории</label>
                            <select class="form-control"
                                    id="category_id"
                                    name="category_id"
                                    placeholder="Выбрать категорию">
                                @foreach($categoryList as $categoryOption)
                                    <option value="{{ $categoryOption->id }}"
                                            @if($categoryOption->id == $item->category_id) selected @endif>{{ $categoryOption->id_title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="excerpt">Выдержка</label>
                            <textarea class="form-control"
                                      id="excerpt"
                                      name="excerpt"
                                      rows="3">{{ old('excerpt', $item->excerpt) }}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <input name="is_published"
                                   type="hidden"
                                    value="0" />
                            <input name="is_published"
                                    type="checkbox"
                                    class="form-check-input"
                                    value="1"
                                    @if($item->is_published)
                                    checked="checked"
                                    @endif
                            >
                            <label for="form-check-label">Опубликовано</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
