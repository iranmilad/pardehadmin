import { createSlice } from "@reduxjs/toolkit";

const initialState = {
    formElements: [],
};

const formElementsSlice = createSlice({
    initialState,
    name: "formElements",
    reducers: {
        // Action to push a new form element
        addFormElement: (state, action) => {
            state.formElements.push(action.payload); // Add new form element
            resortState(state);
        },
        resetAll: (state,action) => {
          state.formElements = [];
          document.getElementById("form-elements").value = JSON.stringify([]);
        },
        // Action to update an existing form element by ID
        updateFormElement: (state, action) => {
            const index = state.formElements.findIndex(
                (el) => el.id === action.payload.id
            );
            if (index !== -1) {
                state.formElements[index].title = action.payload.title; // Update the element if found
                state.formElements[index].required = action.payload.required;
                state.formElements[index].value = action.payload.value;

                resortState(state);
            }
        },
        // Action to remove a form element by ID
        removeFormElement: (state, action) => {
            state.formElements = state.formElements.filter(
                (el) => el.id !== action.payload
            ); // Filter out the element by ID
            // resortState(state);
        },
        updateDetail: (state, action) => {
            const index = state.formElements.findIndex(
                (el) => el.id === action.payload.id
            );
            if (index !== -1) {
                state.formElements[index].x = action.payload.x;
                state.formElements[index].y = action.payload.y;

                state.formElements[index].w = action.payload.w;
                state.formElements[index].h = action.payload.h;
                resortState(state);
            }
        },
        updateWholeState: (state, action) => {
            action.payload.forEach((item) => {
                const itemId = item.id;
                const index = state.formElements.findIndex(
                    (el) => el.id === itemId
                );
                if (index !== -1) {
                    const x = item.x;
                    const y = item.y;
                    const w = item.w;
                    const h = item.h;

                    state.formElements[index].x = x;
                    state.formElements[index].y = y;

                    state.formElements[index].w = w;
                    state.formElements[index].h = h;
                }
            });
            resortState(state);
        },
    },
});

// Export actions
export const {
    addFormElement,
    updateFormElement,
    removeFormElement,
    updateDetail,
    updateWholeState,
    resetAll
} = formElementsSlice.actions;

// Export the reducer
export default formElementsSlice.reducer;

/**
 * Resort state based on x and y
 */
function resortState(state) {
  // Sort the form elements by y, then by x in descending order (higher x first)
  let newState = state.formElements.filter(Boolean).sort((a, b) => {
      if (a.y === b.y) {
          // Sort by x in descending order (higher x comes first)
          return b.x - a.x;
      }
      // Sort by y in ascending order (higher rows come later)
      return a.y - b.y;
  });

  // Update the formElements in state
  state.formElements = newState;

  // Update the form-elements field with the new sorted state
  document.getElementById("form-elements").value = JSON.stringify(newState);
}
