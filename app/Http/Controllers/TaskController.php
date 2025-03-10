<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestTask;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Affiche le tableau des tâches de l'utilisateur authentifié.
     *
     * Cette méthode est liée à la route "/taches" et est accessible uniquement si l'utilisateur est authentifié.
     * Elle renvoie la vue "tasks.index" qui contient un tableau des tâches de l'utilisateur authentifié.
     * Les tâches sont commandées par la date de création descendante.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tasks = Auth::user()->tasks;
        return view('tasks.index', ['tasks' => $tasks]);
    }

    /**
     * Affiche le formulaire de création de tâches.
     *
     * Cette méthode rend la vue du formulaire de création de tâches. Elle est accessible uniquement si l'utilisateur est authentifié. Elle renvoie la vue "tasks.show".
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('tasks.show');
    }

    /**
     * Stockez une tâche nouvellement créée dans la base de données.
     *
     * @param  \App\Http\Requests\RequestTask  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * Cette méthode valide les données de la demande entrante et crée une nouvelle tâche
     * associé à l'utilisateur authentifié.Sur le succès, il redirige vers le
     * Tâches Tableau de bord avec un message de réussite.Si une exception se produit, elle redirige
     * Retour avec un message d'erreur.
     */

    public function store(RequestTask $request)
    {
        try {
            $validatedData = $request->validated();

            Task::create([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'user_id' => Auth::id(),
                'status' => 'completed',
            ]);

            return to_route('tasks.dashboard')->with([
                'message' => [
                    'type' => 'success',
                    'text' => 'La tâche a été enregistrée avec succès.',
                ],
            ]);
        } catch (\Exception $e) {
            return back()->with([
                'message' => [
                    'type' => 'danger',
                    'text' => 'Une erreur est survenue lors de l’enregistrement de la tâche.',
                ],
            ]);
        }
    }

    /**
     * Affiche le formulaire d'édition pour une tâche spécifiée.
     *
     * @param string $encryptedId L'ID de la tâche chiffré.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     * Retourne la vue d'édition de la tâche ou redirige en cas d'erreur.
     */

    public function edit($encryptedId)
    {
        try {
            $taskId = decryptData($encryptedId);

            if (!$taskId) {
                abort(404, 'ID de tâche invalide');
            }

            $task = Task::findOrFail($taskId);

            $this->authorize('update', $task);

            return view('tasks.edit', ['task' => $task]);
        } catch (\Exception $e) {
            return back()->with([
                'message' => [
                    'type' => 'danger',
                    'text' => 'Vous n’avez pas les droits suffisants pour modifier cette tâche.',
                ],
            ]);
        }
    }

    /**
     * Mise à jour d'une tâche.
     *
     * @param  \App\Http\Requests\RequestTask  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(RequestTask $request, Task $task)
    {
        try {
            $validatedData = $request->validated();
            $this->authorize('update', $task);
            $task->update($validatedData);

            return to_route('tasks.dashboard')->with([
                'message' => [
                    'type' => 'success',
                    'text' => 'La tâche a été mise à jour avec succès.',
                ],
            ]);
        } catch (\Exception $e) {
            return back()->with([
                'message' => [
                    'type' => 'danger',
                    'text' => 'Une erreur est survenue lors de la mise à jour de la tâche.',
                ],
            ]);
        }
    }

    /**
     * Marque une tâche comme complétée.
     *
     * Cette méthode autorise l'utilisateur à mettre à jour la tâche et modifie son statut en "completed".
     * Elle renvoie l'utilisateur au tableau de bord des tâches avec un message de succès.
     * En cas d'erreur, elle renvoie l'utilisateur à la page précédente avec un message d'erreur.
     *
     * @param \App\Models\Task $task La tâche à marquer comme complétée.
     *
     * @return \Illuminate\Http\RedirectResponse
     */

    public function complete(Task $task)
    {
        try {
            $this->authorize('update', $task);
            $task->update([
                'status' => 'completed',
            ]);

            return to_route('tasks.dashboard')->with([
                'message' => [
                    'type' => 'success',
                    'text' => 'La tâche a été complétée avec succès.',
                ],
            ]);
        } catch (\Exception $e) {
            return back()->with([
                'message' => [
                    'type' => 'danger',
                    'text' => 'Une erreur est survenue lors de la mise à jour de la tâche.',
                ],
            ]);
        }
    }

    /**
     * Supprime une tâche.
     *
     * @param string $encryptedId L'ID de la tâche chiffré.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($encryptedId)
    {
        try {
            $taskId = decryptData($encryptedId);

            if (!$taskId) {
                abort(404, 'ID de tâche invalide');
            }

            $task = Task::findOrFail($taskId);

            $this->authorize('delete', $task);

            $task->delete();

            return to_route('tasks.dashboard')->with([
                'message' => [
                    'type' => 'success',
                    'text' => 'La tâche a été supprimée avec succès.',
                ],
            ]);
        } catch (\Exception $e) {
            return back()->with([
                'message' => [
                    'type' => 'danger',
                    'text' => 'Une erreur est survenue lors de la suppression de la tâche.',
                ],
            ]);
        }
    }
}
