/**
 * Check if the time is past of given hours
 *
 * @param {number} hours
 * @param {string} date
 *
 * @returns {string}
 */
export default function checkPastTime(date, hours = 1) {
  if (!date) {
    return;
  }

  const givenTime = new Date(date.replace(' ', 'T') + 'Z');
  const oneHourAgo = new Date();
  oneHourAgo.setHours(oneHourAgo.getHours() - hours);

  return givenTime < oneHourAgo;
}
