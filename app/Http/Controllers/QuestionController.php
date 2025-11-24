<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Event;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    // Listar perguntas de um evento
    public function index($eventId)
    {
        $questions = Question::where('event_id', $eventId)
            ->with(['user', 'answeredBy'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($questions);
    }

    // Criar pergunta (Aluno)
    public function store(Request $request, $eventId)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:1000',
        ]);

        $question = Question::create([
            'event_id' => $eventId,
            'user_id' => auth()->id(),
            'question' => $validated['question'],
        ]);

        $question->load(['user', 'answeredBy']);

        return response()->json($question, 201);
    }

    // Atualizar pergunta (Aluno - apenas sua própria pergunta)
    public function update(Request $request, $questionId)
    {
        $question = Question::findOrFail($questionId);

        // Verificar se é o dono da pergunta
        if ($question->user_id !== auth()->id()) {
            return response()->json(['message' => 'Não autorizado'], 403);
        }

        $validated = $request->validate([
            'question' => 'required|string|max:1000',
        ]);

        $question->update([
            'question' => $validated['question'],
        ]);

        $question->load(['user', 'answeredBy']);

        return response()->json($question);
    }

    // Deletar pergunta (Aluno - apenas sua própria pergunta)
    public function destroy($questionId)
    {
        $question = Question::findOrFail($questionId);

        // Verificar se é o dono da pergunta
        if ($question->user_id !== auth()->id()) {
            return response()->json(['message' => 'Não autorizado'], 403);
        }

        $question->delete();

        return response()->json(['message' => 'Pergunta deletada com sucesso']);
    }

    // Responder pergunta (Admin)
    public function answer(Request $request, $questionId)
    {
        $question = Question::findOrFail($questionId);

        $validated = $request->validate([
            'answer' => 'required|string|max:2000',
        ]);

        $question->update([
            'answer' => $validated['answer'],
            'answered_by' => auth()->id(),
            'answered_at' => now(),
        ]);

        $question->load(['user', 'answeredBy']);

        return response()->json($question);
    }

    // Atualizar resposta (Admin)
    public function updateAnswer(Request $request, $questionId)
    {
        $question = Question::findOrFail($questionId);

        $validated = $request->validate([
            'answer' => 'required|string|max:2000',
        ]);

        $question->update([
            'answer' => $validated['answer'],
            'answered_at' => now(),
        ]);

        $question->load(['user', 'answeredBy']);

        return response()->json($question);
    }

    // Deletar resposta (Admin)
    public function deleteAnswer($questionId)
    {
        $question = Question::findOrFail($questionId);

        $question->update([
            'answer' => null,
            'answered_by' => null,
            'answered_at' => null,
        ]);

        $question->load(['user', 'answeredBy']);

        return response()->json($question);
    }
}
