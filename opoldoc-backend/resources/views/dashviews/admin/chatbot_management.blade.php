<div class="bg-white border border-slate-200 rounded-[18px] p-5 shadow-[0_2px_10px_rgba(15,23,42,0.04)]">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-sm font-semibold text-slate-900">Chatbot Management</h2>
        <span class="text-[0.7rem] text-slate-400 uppercase tracking-widest">Chatbot</span>
    </div>
    <p class="text-xs text-slate-500 mb-4">
        Add questions, options, and connect them to build a simple decision-tree flow.
    </p>

    <div id="adminChatbotError" class="hidden mb-3 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-[0.75rem] text-red-700"></div>

    <form id="adminChatbotQuestionForm" class="mb-4 grid gap-2 grid-cols-1 md:grid-cols-3 items-end">
        <div class="md:col-span-2">
            <label for="admin_question_text" class="block text-[0.7rem] text-slate-600 mb-1">Question text</label>
            <input id="admin_question_text" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="How can we help you today?" required>
        </div>
        <div class="flex items-center gap-2 md:justify-end">
            <button type="submit" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-cyan-600 text-white text-[0.78rem] font-semibold hover:bg-cyan-700 transition-colors">
                Add Question
            </button>
        </div>
    </form>

    <div class="mb-3 flex flex-col gap-2 md:flex-row md:items-end">
        <div class="flex-1">
            <label for="admin_chatbot_search" class="block text-[0.7rem] text-slate-600 mb-1">Search questions</label>
            <input id="admin_chatbot_search" type="text" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none" placeholder="Search by question or option text">
        </div>
        <div class="w-full md:w-40">
            <label for="admin_chatbot_sort" class="block text-[0.7rem] text-slate-600 mb-1">Sort</label>
            <select id="admin_chatbot_sort" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 outline-none">
                <option value="recent">Most recent</option>
                <option value="alpha">Alphabetical</option>
            </select>
        </div>
    </div>

    <div class="grid gap-4 grid-cols-1 lg:grid-cols-[minmax(0,2fr)_minmax(0,1.2fr)]">
        <div class="border border-slate-100 rounded-2xl p-4 bg-slate-50/60">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-xs font-semibold text-slate-900">Questions & options</h3>
                <span class="text-[0.68rem] text-slate-400 uppercase tracking-widest">List</span>
            </div>

            <div id="admin_chatbot_questions_container" class="space-y-3 max-h-[420px] overflow-y-auto pr-1">
                <p class="text-[0.78rem] text-slate-400">Loading questions…</p>
            </div>
        </div>

        <div class="border border-slate-100 rounded-2xl p-4 bg-slate-50/60">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-xs font-semibold text-slate-900">Flow preview</h3>
                <span class="text-[0.68rem] text-slate-400 uppercase tracking-widest">Preview</span>
            </div>
            <p class="text-[0.72rem] text-slate-500 mb-3">
                Click a question on the left to preview how options lead to the next question.
            </p>
            <div id="admin_chatbot_flow_preview" class="text-[0.78rem] text-slate-700">
                <p class="text-[0.78rem] text-slate-400">No question selected yet.</p>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var errorBox = document.getElementById('adminChatbotError')
        var questionForm = document.getElementById('adminChatbotQuestionForm')
        var questionInput = document.getElementById('admin_question_text')
        var searchInput = document.getElementById('admin_chatbot_search')
        var sortSelect = document.getElementById('admin_chatbot_sort')
        var questionsContainer = document.getElementById('admin_chatbot_questions_container')
        var flowPreview = document.getElementById('admin_chatbot_flow_preview')

        var chatbotQuestions = []

        function showChatbotError(message) {
            if (!errorBox) return
            errorBox.textContent = message || ''
            if (message) {
                errorBox.classList.remove('hidden')
            } else {
                errorBox.classList.add('hidden')
            }
        }

        function loadChatbotConfig() {
            questionsContainer.innerHTML = '<p class="text-[0.78rem] text-slate-400">Loading questions…</p>'

            apiFetch("{{ url('/api/chatbot/questions') }}", {
                method: 'GET'
            })
                .then(function (response) {
                    return response.json().then(function (data) {
                        return { ok: response.ok, data: data }
                    })
                })
                .then(function (result) {
                    if (!result.ok) {
                        questionsContainer.innerHTML = '<p class="text-[0.78rem] text-red-500">Failed to load chatbot questions.</p>'
                        return
                    }
                    var payload = result.data
                    chatbotQuestions = Array.isArray(payload.data) ? payload.data : payload
                    renderQuestions()
                })
                .catch(function () {
                    questionsContainer.innerHTML = '<p class="text-[0.78rem] text-red-500">Network error while loading chatbot questions.</p>'
                })
        }

        function findQuestionById(id) {
            return chatbotQuestions.find(function (q) {
                return String(q.id) === String(id)
            })
        }

        function renderFlowPreview(questionId) {
            if (!flowPreview) return
            var question = findQuestionById(questionId)
            if (!question) {
                flowPreview.innerHTML = '<p class="text-[0.78rem] text-slate-400">No question selected yet.</p>'
                return
            }

            var html = ''
            html += '<div class="mb-3">'
            html += '<div class="inline-flex items-center rounded-full bg-cyan-50 px-3 py-1 text-[0.68rem] text-cyan-800 font-semibold mb-2">Question #' + question.id + '</div>'
            html += '<p class="text-[0.8rem] font-semibold text-slate-900 mb-2">' + (question.text || '') + '</p>'
            html += '</div>'

            var opts = Array.isArray(question.options) ? question.options : []
            if (!opts.length) {
                html += '<p class="text-[0.75rem] text-slate-500">No options configured yet.</p>'
            } else {
                html += '<div class="space-y-2">'
                opts.forEach(function (opt) {
                    var next = opt.next_question_id ? findQuestionById(opt.next_question_id) : null
                    html += '<div class="rounded-xl border border-slate-200 bg-white px-3 py-2">'
                    html += '<div class="flex items-center justify-between mb-1">'
                    html += '<span class="text-[0.75rem] font-semibold text-slate-800">' + (opt.option_text || '') + '</span>'
                    if (next) {
                        html += '<span class="text-[0.68rem] text-cyan-700">Next → #' + next.id + '</span>'
                    } else {
                        html += '<span class="text-[0.68rem] text-slate-400">End</span>'
                    }
                    html += '</div>'
                    if (opt.response_text) {
                        html += '<p class="text-[0.72rem] text-slate-500">' + opt.response_text + '</p>'
                    }
                    html += '</div>'
                })
                html += '</div>'
            }

            flowPreview.innerHTML = html
        }

        function renderQuestions() {
            if (!questionsContainer) return

            var query = searchInput ? searchInput.value.toLowerCase().trim() : ''
            var sort = sortSelect ? sortSelect.value : 'recent'

            var filtered = chatbotQuestions.slice().filter(function (q) {
                var text = (q.text || '').toLowerCase()
                var options = Array.isArray(q.options) ? q.options : []
                var optionsText = options.map(function (o) { return (o.option_text || '').toLowerCase() + ' ' + (o.response_text || '').toLowerCase() }).join(' ')
                if (!query) return true
                return text.indexOf(query) !== -1 || optionsText.indexOf(query) !== -1
            })

            filtered.sort(function (a, b) {
                if (sort === 'alpha') {
                    var ta = (a.text || '').toLowerCase()
                    var tb = (b.text || '').toLowerCase()
                    if (ta < tb) return -1
                    if (ta > tb) return 1
                    return 0
                }
                var ia = parseInt(a.id, 10) || 0
                var ib = parseInt(b.id, 10) || 0
                return ib - ia
            })

            if (!filtered.length) {
                questionsContainer.innerHTML = '<p class="text-[0.78rem] text-slate-400">No questions configured yet.</p>'
                flowPreview.innerHTML = '<p class="text-[0.78rem] text-slate-400">No question selected yet.</p>'
                return
            }

            questionsContainer.innerHTML = ''

            filtered.forEach(function (q) {
                var wrapper = document.createElement('div')
                wrapper.className = 'rounded-2xl border border-slate-200 bg-white px-3 py-2.5'
                wrapper.setAttribute('data-question-id', q.id)

                var options = Array.isArray(q.options) ? q.options : []

                var html = ''
                html += '<div class="flex items-start justify-between gap-2 mb-1.5">'
                html += '<div class="flex-1">'
                html += '<p class="text-[0.78rem] font-semibold text-slate-900 mb-0.5">' + (q.text || '') + '</p>'
                html += '<p class="text-[0.68rem] text-slate-400">Question #' + q.id + '</p>'
                html += '</div>'
                html += '<div class="flex items-center gap-2">'
                html += '<button type="button" class="text-[0.7rem] text-cyan-700 hover:text-cyan-800 font-semibold admin-chatbot-question-edit" data-question-id="' + q.id + '">Edit</button>'
                html += '<button type="button" class="text-[0.7rem] text-rose-600 hover:text-rose-700 font-semibold admin-chatbot-question-delete" data-question-id="' + q.id + '">Delete</button>'
                html += '</div>'
                html += '</div>'

                html += '<div class="mt-1.5 mb-1 flex items-center justify-between">'
                html += '<p class="text-[0.7rem] text-slate-500">Options</p>'
                html += '<button type="button" class="inline-flex items-center gap-1 rounded-lg border border-cyan-500/50 bg-cyan-50 px-2.5 py-1 text-[0.7rem] font-semibold text-cyan-700 hover:bg-cyan-100 admin-chatbot-option-add" data-question-id="' + q.id + '">'
                html += '<span>+ Add Option</span>'
                html += '</button>'
                html += '</div>'

                if (!options.length) {
                    html += '<p class="text-[0.72rem] text-slate-400">No options yet.</p>'
                } else {
                    html += '<ul class="space-y-1.5">'
                    options.forEach(function (opt) {
                        html += '<li class="flex items-start justify-between gap-2 rounded-xl border border-slate-100 bg-slate-50 px-2.5 py-1.5">'
                        html += '<div class="flex-1">'
                        html += '<p class="text-[0.75rem] font-medium text-slate-800">' + (opt.option_text || '') + '</p>'
                        if (opt.response_text) {
                            html += '<p class="text-[0.7rem] text-slate-500">' + opt.response_text + '</p>'
                        }
                        if (opt.next_question_id) {
                            html += '<p class="text-[0.68rem] text-cyan-700 mt-0.5">Next → Question #' + opt.next_question_id + '</p>'
                        } else {
                            html += '<p class="text-[0.68rem] text-slate-400 mt-0.5">Ends flow</p>'
                        }
                        html += '</div>'
                        html += '<div class="flex items-center gap-1">'
                        html += '<button type="button" class="text-[0.68rem] text-cyan-700 hover:text-cyan-800 font-semibold admin-chatbot-option-edit" data-question-id="' + q.id + '" data-option-id="' + opt.id + '">Edit</button>'
                        html += '<button type="button" class="text-[0.68rem] text-rose-600 hover:text-rose-700 font-semibold admin-chatbot-option-delete" data-question-id="' + q.id + '" data-option-id="' + opt.id + '">Delete</button>'
                        html += '</div>'
                        html += '</li>'
                    })
                    html += '</ul>'
                }

                wrapper.innerHTML = html
                questionsContainer.appendChild(wrapper)
            })

            var questionCards = questionsContainer.querySelectorAll('[data-question-id]')
            questionCards.forEach(function (card) {
                card.addEventListener('click', function (e) {
                    if (e.target.closest('button')) return
                    var id = card.getAttribute('data-question-id')
                    renderFlowPreview(id)
                })
            })

            var editButtons = questionsContainer.querySelectorAll('.admin-chatbot-question-edit')
            editButtons.forEach(function (button) {
                button.addEventListener('click', function (e) {
                    e.stopPropagation()
                    var id = this.getAttribute('data-question-id')
                    var question = findQuestionById(id)
                    if (!question) return
                    var newText = window.prompt('Question text', question.text || '') || ''
                    if (!newText.trim()) return

                    apiFetch("{{ url('/api/chatbot/questions') }}/" + id, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ text: newText })
                    })
                        .then(function (response) {
                            return response.json().then(function (data) {
                                return { ok: response.ok, data: data }
                            })
                        })
                        .then(function (result) {
                            if (!result.ok) {
                                showChatbotError('Failed to update question.')
                                return
                            }
                            loadChatbotConfig()
                        })
                        .catch(function () {
                            showChatbotError('Network error while updating question.')
                        })
                })
            })

            var deleteButtons = questionsContainer.querySelectorAll('.admin-chatbot-question-delete')
            deleteButtons.forEach(function (button) {
                button.addEventListener('click', function (e) {
                    e.stopPropagation()
                    var id = this.getAttribute('data-question-id')
                    if (!id) return
                    if (!window.confirm('Delete this question and its options?')) return

                    apiFetch("{{ url('/api/chatbot/questions') }}/" + id, {
                        method: 'DELETE'
                    })
                        .then(function (response) {
                            return response.json().then(function (data) {
                                return { ok: response.ok, data: data }
                            })
                        })
                        .then(function (result) {
                            if (!result.ok) {
                                showChatbotError('Failed to delete question.')
                                return
                            }
                            loadChatbotConfig()
                        })
                        .catch(function () {
                            showChatbotError('Network error while deleting question.')
                        })
                })
            })

            var addOptionButtons = questionsContainer.querySelectorAll('.admin-chatbot-option-add')
            addOptionButtons.forEach(function (button) {
                button.addEventListener('click', function (e) {
                    e.stopPropagation()
                    var questionId = this.getAttribute('data-question-id')
                    var optText = window.prompt('Option text') || ''
                    if (!optText.trim()) return
                    var responseText = window.prompt('Response text (optional)') || ''

                    var nextId = null
                    if (chatbotQuestions.length > 0) {
                        var nextInput = window.prompt('Next question ID (leave blank if this ends the flow)', '')
                        if (nextInput && nextInput.trim() !== '') {
                            nextId = parseInt(nextInput.trim(), 10)
                            if (!nextId) {
                                nextId = null
                            }
                        }
                    }

                    var body = {
                        option_text: optText,
                        response_text: responseText || null,
                        next_question_id: nextId
                    }

                    apiFetch("{{ url('/api/chatbot/questions') }}/" + questionId + "/options", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(body)
                    })
                        .then(function (response) {
                            return response.json().then(function (data) {
                                return { ok: response.ok, data: data }
                            })
                        })
                        .then(function (result) {
                            if (!result.ok) {
                                showChatbotError('Failed to add option.')
                                return
                            }
                            loadChatbotConfig()
                        })
                        .catch(function () {
                            showChatbotError('Network error while adding option.')
                        })
                })
            })

            var editOptionButtons = questionsContainer.querySelectorAll('.admin-chatbot-option-edit')
            editOptionButtons.forEach(function (button) {
                button.addEventListener('click', function (e) {
                    e.stopPropagation()
                    var questionId = this.getAttribute('data-question-id')
                    var optionId = this.getAttribute('data-option-id')
                    var question = findQuestionById(questionId)
                    if (!question) return
                    var option = (Array.isArray(question.options) ? question.options : []).find(function (o) {
                        return String(o.id) === String(optionId)
                    })
                    if (!option) return

                    var newText = window.prompt('Option text', option.option_text || '') || ''
                    if (!newText.trim()) return
                    var newResponse = window.prompt('Response text (optional)', option.response_text || '') || ''
                    var nextPrompt = window.prompt('Next question ID (leave blank if this ends the flow)', option.next_question_id ? String(option.next_question_id) : '') || ''
                    var nextId = nextPrompt.trim() === '' ? null : parseInt(nextPrompt.trim(), 10)
                    if (!nextId) {
                        nextId = null
                    }

                    var body = {
                        option_text: newText,
                        response_text: newResponse || null,
                        next_question_id: nextId
                    }

                    apiFetch("{{ url('/api/chatbot/options') }}/" + optionId, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(body)
                    })
                        .then(function (response) {
                            return response.json().then(function (data) {
                                return { ok: response.ok, data: data }
                            })
                        })
                        .then(function (result) {
                            if (!result.ok) {
                                showChatbotError('Failed to update option.')
                                return
                            }
                            loadChatbotConfig()
                        })
                        .catch(function () {
                            showChatbotError('Network error while updating option.')
                        })
                })
            })

            var deleteOptionButtons = questionsContainer.querySelectorAll('.admin-chatbot-option-delete')
            deleteOptionButtons.forEach(function (button) {
                button.addEventListener('click', function (e) {
                    e.stopPropagation()
                    var optionId = this.getAttribute('data-option-id')
                    if (!optionId) return
                    if (!window.confirm('Delete this option?')) return

                    apiFetch("{{ url('/api/chatbot/options') }}/" + optionId, {
                        method: 'DELETE'
                    })
                        .then(function (response) {
                            return response.json().then(function (data) {
                                return { ok: response.ok, data: data }
                            })
                        })
                        .then(function (result) {
                            if (!result.ok) {
                                showChatbotError('Failed to delete option.')
                                return
                            }
                            loadChatbotConfig()
                        })
                        .catch(function () {
                            showChatbotError('Network error while deleting option.')
                        })
                })
            })
        }

        if (questionForm) {
            questionForm.addEventListener('submit', function (e) {
                e.preventDefault()
                showChatbotError('')
                var text = questionInput ? questionInput.value.trim() : ''
                if (!text) {
                    showChatbotError('Question text is required.')
                    return
                }

                apiFetch("{{ url('/api/chatbot/questions') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ text: text })
                })
                    .then(function (response) {
                        return response.json().then(function (data) {
                            return { ok: response.ok, data: data }
                        })
                    })
                    .then(function (result) {
                        if (!result.ok) {
                            showChatbotError('Failed to add question.')
                            return
                        }
                        if (questionInput) questionInput.value = ''
                        loadChatbotConfig()
                    })
                    .catch(function () {
                        showChatbotError('Network error while adding question.')
                    })
            })
        }

        if (searchInput) {
            searchInput.addEventListener('input', function () {
                renderQuestions()
            })
        }
        if (sortSelect) {
            sortSelect.addEventListener('change', function () {
                renderQuestions()
            })
        }

        loadChatbotConfig()
    })
</script>

